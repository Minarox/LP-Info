<h1>Groupes de la classe LP DEV WEB</h1>

<h2>Veuillez indiquer le nombre de personnes dans l'url pour créer les groupes. Ex : "/4"</h2>

<div class="container">

    <?php

    if (isset($class)):
        if (is_array($class)):
            foreach ($class as $keyClass => $allClass):
                echo "<table class='table table-striped table-bordered table-dark'>";
                foreach ($allClass as $k => $v):
                    echo "<tr> <td>$k</td> <td>$v[0]</td> <td>$v[1]</td> <td>$v[2]</td></tr>";
                endforeach;
                echo "</table>";
            endforeach;
        else:
            echo $class;
        endif;
    endif;

    ?>

</div>