<?php


namespace App\Controllers;


use App\Core\System\Controller;
use App\Models\SensorsModel;
use App\Models\Sensor_DataModel;
use App\Models\Sensor_TypesModel;

class SensorsController extends Controller
{
    public function index()
    {
        $sensors = new SensorsModel();
        $sensor_data = new Sensor_DataModel();
        $sensor_types = new Sensor_TypesModel();
        $link = array(
            "https://hothothot.dog/api/capteurs/interieur",
            "https://hothothot.dog/api/capteurs/exterieur"
        );

        function data($url)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:19.0) Gecko/20100101 Firefox/19.0');
            $content = curl_exec($ch);
            curl_close($ch);
            return json_decode($content, true);
        }

        foreach ($link as $url) {
            $data = data($url);

            $sensor = $sensors->findOneBy([
                'name' => $data['capteurs'][0]['Nom']
            ]);

            if (empty($sensor)) {
                $sensor_type = $sensor_types->findOneBy([
                    'name' => $data['capteurs'][0]['type']
                ]);

                if (empty($sensor_type)) {
                    $sensor_type = $sensor_types->setName($data['capteurs'][0]['type'])
                        ->create();
                }

                //TODO : erreur de getId lors de la création d'un capteur
                $sensor = $sensors->setTypeId($sensor_type->getId())
                    ->setName($data['capteurs'][0]['Nom'])
                    ->setActive(1)
                    ->create();
            }

            $sensor_data->setSensorId($sensor->getId())
                ->setTemperature($data['capteurs'][0]['Valeur'])
                ->create();
        }
    }
}