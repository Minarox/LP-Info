<?php

class ClassroomController {

    // Liste des formations disponibles
    public static function formations() {
        $O_model = new ClassroomModel();
        Buffer::show("FormationsView", array('formations' => $O_model->getFormations()));
    }

    // Informations d'une formation en particulier
    public static function formation($I_id) {
        $O_model = new ClassroomModel();
        $A_formation = $O_model->getFormation($I_id);
        if (!$A_formation) {
            ErrorController::error404("Formation");
            return;
        }
        Buffer::show("FormationView", array('formation' => $O_model->getFormation($I_id)));
    }

    // Liste des étudiants de la formation
    public static function students() {
        $O_model = new ClassroomModel();
        Buffer::show("StudentsView", array('students' => $O_model->getStudents()));
    }

    // Information d'un étudiant en particulier de la formation
    public static function student($I_id) {
        $O_model = new ClassroomModel();
        Buffer::show("StudentView", array('student' => $O_model->getStudent($I_id)));
    }

    // Nombre d'étudiants suivant la formation et création des groupes
    public static function groups() {
        $O_model = new ClassroomModel();
        $A_students = $O_model->getStudents();
        Buffer::show("CreateGroupsView", array('numberStudents' => count($A_students)));
    }

    // Création des groupes en fonction du nombre d'étudiants suivant la formation
    public static function createGroups($I_size) {
        if ($I_size == null) {
            ErrorController::error400();
            return;
        }
        $O_model = new ClassroomModel();
        $A_students = $O_model->getStudents();
        $I_nbStudent = 0;
        $I_nbGroup = 0;
        $A_group = array();
        while ($I_nbStudent != count($A_students)) {
            for ($I_i = 0; $I_i < $I_size; $I_i++) {
                if ($I_nbStudent != count($A_students)) {
                    $I_r = rand(0,count($A_students)-1);
                    if (preg_match('/"'.preg_quote($A_students[$I_r]["last-name"], '/').'"/i' , json_encode($A_group)) == 1) {
                        $I_i--;
                    } else {
                        $A_group[$I_nbGroup][$I_i] = $A_students[$I_r];
                        $I_nbStudent++;
                    }
                }
            }
            $I_nbGroup++;
        }
        Buffer::show("GroupsView", array('groups' => $A_group));
    }

}