<?php

// Page affichant la liste des formations
echo "<h1>Liste des formations :</h1>";

foreach ($A_result['formations'] as $formation) {
    echo "<h2>Formation ".$formation['id']." :</h2>
        <ul>
            <li>".$formation['course']."</li>
            <li>".$formation['training']."</li>
            <li>".$formation['year']."</li>
        </ul>";
}