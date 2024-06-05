<?php

class ClassroomModel {

    // Renvoie toutes les informations de la formation
    public function getFormations() {
        $A_query = DB::PDO()->prepare("SELECT * FROM Formation");
        $A_query->execute();
        return $A_query->fetchAll();
    }

    // Renvoie toutes les informations de la formation
    public function getFormation($I_id) {
        $A_query = DB::PDO()->prepare("SELECT * FROM Formation WHERE id=$I_id");
        $A_query->execute();
        return $A_query->fetch();
    }

    // Renvoie la liste d'élèves de la formation
    public function getStudents() {
        $A_query = DB::PDO()->prepare("SELECT * FROM Etudiants WHERE formation = '1'");
        $A_query->execute();
        return $A_query->fetchAll();
    }

    // Renvoie les informations d'un élève de la formation
    public function getStudent($I_id) {
        $A_query = DB::PDO()->prepare("SELECT * FROM Etudiants WHERE formation = '1' AND id=$I_id");
        $A_query->execute();
        return $A_query->fetch();
    }

}