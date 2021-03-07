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

        foreach (SENSOR_LINKS as $url) {
            $data = data($url);

            if (!empty($data)) {
                $sensor = $sensors->findOneBy([
                    'name' => $data['capteurs'][0]['Nom']
                ]);

                if (empty($sensor)) {
                    $sensor_type = $sensor_types->findOneBy([
                        'name' => $data['capteurs'][0]['type']
                    ]);

                    if (empty($sensor_type)) {
                        $sensor_types->setName($data['capteurs'][0]['type'])
                            ->create();

                        $sensor_type = $sensor_types->findOneBy([
                            'name' => $data['capteurs'][0]['type']
                        ]);
                    }

                    $sensors->setTypeId($sensor_type->getId())
                        ->setName($data['capteurs'][0]['Nom'])
                        ->setActive(1)
                        ->create();

                    $sensor = $sensors->findOneBy([
                        'name' => $data['capteurs'][0]['Nom']
                    ]);
                }

                $sensor_data->setSensorId($sensor->getId())
                    ->setTemperature($data['capteurs'][0]['Valeur'])
                    ->create();
            }
        }

        $this->get();
    }
    public static function get()
    {
        $sensors = new SensorsModel();
        $sensor_data = new Sensor_DataModel();
        $sensor_types = new Sensor_TypesModel();

        $list = $sensors->findAll();

        $i = 0;
        $data = [];

        foreach ($list as $sensor) {
            $type = $sensor_types->findOneBy([
                'id' => $sensor->getTypeId()
            ]);

            $data[$i]['name'] = $sensor->getName();
            $data[$i]['type'] = $type->getName();

            $data_raw = $sensor_data->findBy([
                'sensor_id' => $sensor->getId()
            ]);

            $data[$i]['data'] = array_slice($data_raw, -128);
            $i++;
        }

        define('DATA_SENSORS', json_encode($data));
        define('NUMBER_SENSORS', count($list)-1);
    }
}