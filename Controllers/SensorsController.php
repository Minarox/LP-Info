<?php


namespace App\Controllers;


use App\Core\System\Controller;
use App\Models\SensorsModel;
use App\Models\Sensor_DataModel;
use App\Models\Sensor_TypesModel;

class SensorsController extends Controller
{
    // Faire un appel à la fonction avec l'url du capteur à récupérer
    public function index()
    {
        $sensors = new SensorsModel();
        $sensor_data = new Sensor_DataModel();
        $sensor_types = new Sensor_TypesModel();

        // A virer
        function data($url)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:19.0) Gecko/20100101 Firefox/19.0');
            $content = curl_exec($ch);
            curl_close($ch);
            return json_decode($content, true);
        }

        // - Récupérer les données du capteur
        $data = data('https://hothothot.dog/api/capteurs/interieur');

        // - vérifier si le capteur existe dans la bdd
        $sensor = $sensors->findOneBy([
            'name' => $data['capteurs'][0]['Nom']
        ]);

        // - s'il n'existe pas :
        if (empty($sensor)) {

            // - vérifier si la catégorie de capteur existe
            $sensor_type = $sensor_types->findOneBy([
                'name' => $data['capteurs'][0]['type']
            ]);

            // - s'il n'existe pas :
            if (empty($sensor_type)) {
                // - créer cette nouvelle catégorie
                $sensor_types->setName($data['capteurs'][0]['type'])
                    ->create();

                // - récupérer l'id du type dans la bdd
                $sensor_type = $sensor_types->findOneBy([
                    'name' => $data['capteurs'][0]['type']
                ]);
            }

            // - ajouter le nouveau capteur avec la bonne catégorie
            $sensors->setTypeId($sensor_type->getId())
                ->setName($data['capteurs'][0]['Nom'])
                ->setActive(1)
                ->create();

            // - récupérer l'id du capteur dans la bdd
            $sensor = $sensors->findOneBy([
                'name' => $data['capteurs'][0]['Nom']
            ]);
        }

        // - entrer les nouvelles données dans la bdd
        $sensor_data->setSensorId($sensor->getId())
            ->setTemperature($data['capteurs'][0]['Valeur'])
            ->create();


//        $outdoor_sensor = data('https://hothothot.dog/api/capteurs/exterieur');
    }
}