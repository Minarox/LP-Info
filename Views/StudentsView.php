<?php

// Page affichant la liste des étudiants suivant la formation
echo "<h1>Liste des étudiants</h1>
            <ul>";

foreach ($A_result['students'] as $student) {
    echo "<li>".$student['gender'].". ".$student['first-name']." ".$student['last-name']."</li>";
}

echo "</ul>";