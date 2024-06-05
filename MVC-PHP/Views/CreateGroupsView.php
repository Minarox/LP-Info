<?php

// Page affichant la liste des étudiants et la création des groupes
echo "<h1>Création d'un groupe :</h1>
        <p>Nombre d'étudiants : ".$A_result['numberStudents']."</p>
        <form action='list_groups' method='post'>
            <input type='text' name='number' placeholder='Étudiants par groupe' required>
            <button type='submit'>Créer</button>
        </form>";