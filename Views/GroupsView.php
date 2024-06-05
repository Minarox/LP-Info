<?php

// Page affichant les différents groupes générés
echo "<h1>Groupes d'étudiants :</h1>";

for ($I_i = 0; $I_i < count($A_result['groups']); $I_i++) {
    echo "<h2>Groupe ".($I_i+1)." :</h2><ul>";
    for ($I_y = 0; $I_y < count($A_result['groups'][$I_i]); $I_y++) {
        echo "<li>".$A_result['groups'][$I_i][$I_y]['gender'].". ".$A_result['groups'][$I_i][$I_y]['first-name']." ".$A_result['groups'][$I_i][$I_y]['last-name']."</li>";
    }
    echo "</ul>";
}