<h1>Groupes de <?= $params['number'] = $params['number'] ?? null ?> personnes</h1>

<div class="container">

    <?php if (isset($group)): ?>

        <?php if (is_array($group)) : ?>
            <?php foreach ($group as $keyGroup => $eachGroup): ?>
                <?php $keyGroup += 1 ?>
                <h2><?= "Groupe $keyGroup :" ?></h2>
                <table class='table table-striped table-bordered table-dark'>
                    <?php foreach ($eachGroup as $k => $v): ?>
                        <?php $k += 1 ?>
                        <tr><?= "<td class='col-2'>$k</td> <td class='col-2'>$v[0]</td> <td class='col-4'>$v[1]</td> <td class='col-4'>$v[2]</td>" ?></tr>
                    <?php endforeach; ?>
                </table>
            <?php endforeach; ?>

        <?php else: ?>
            <?= $group ?>
        <?php endif; ?>
    <?php endif; ?>

</div>
