<?php

// Page affichant des informations d'une formation
echo "<h1>Formation ".$A_result['formation']['id']." :</h1>
        <ul>
            <li>".$A_result['formation']['course']."</li>
            <li>".$A_result['formation']['training']."</li>
            <li>".$A_result['formation']['year']."</li>
        </ul>";