<?php


namespace App\Controllers;



use App\Core\Classes\SuperGlobals\Request;
use App\Core\Classes\Validator;
use App\Core\System\Controller;
use App\Models\AlertModel;
use App\Models\UsersModel;

final class SettingsController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->isAuthenticated()) $this->redirect(header: 'login', response_code: 301);

        $validator = new Validator($_POST);
        $user = new UsersModel();

        if ($validator->isSubmitted('update-parameters')) {

            $validator->validate([
                'value-sensors' => ['required', 'int'],
                'value-comparison' => ['required', 'int']
            ]);

            if ($validator->isSuccess()) {
                if ($request->post->get('value-sensors') > $request->post->get('value-comparison')) {
                    $this->addFlash('error', 'Le nombre de données à comparer doit être supérieur au nombre de donnée par capteur !');
                    $this->redirect(header: 'settings', response_code: 301);
                }

                $user->setNbValuesComparison($request->post->get('value-sensors'))
                    ->setNbValuesSensors($request->post->get('value-comparison'))
                    ->update($request->session->get('id'));

                $request->session->set('nb_values_sensors', $request->post->get('value-sensors'));
                $request->session->set('nb_values_comparison', $request->post->get('value-comparison'));

                $this->addFlash('success', 'Les paramètres ont bien été modifiées !');
                $this->redirect(header: 'settings', response_code: 301);
            } else {
                $error = $validator->displayErrors();
            }
        }

        $this->render(name_file: 'other/settings', params: [
            'error' => $error ??= null
        ], title: 'Paramétrages', caching: false);
    }

    public static function id(int $id): array
    {
        $alert = new AlertModel();

        $alerts = $alert->findBy([
            'user_id' => $_SESSION['id'],
            'sensor_id' => $id
        ]);

        $alert_list = [];

        foreach ($alerts as $alert) {
            $alert_list[]['id'] = $alert->getId();
            $alert_list[]['name'] = $alert->getName();
        }

        for($i = 0; $i < count($alerts); $i++) {
            $alert_list[]['id'] = $alert->getId();
            $alert_list[]['name'] = $alert->getName();
        }

        return $alert_list;
    }
}