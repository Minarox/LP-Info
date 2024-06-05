<?php

// Page affichant les informations d'un étudiant en particulier suivant la formation
echo "<h1>Étudiant n°".$A_result['student']['id']."</h1>
        <ul>
            <li>".$A_result['student']['gender'].". ".$A_result['student']['first-name']." ".$A_result['student']['last-name']."</li>
        </ul>";