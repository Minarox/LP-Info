<main class="container-md">
    <section class="mb-3">
        <!-- Titre -->
        <h2 class="box-title hr">Player horses</h2>

        <form method="post">

            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                    <tr>
                        <th class="cw-45 checkbox"><input type="checkbox" id="select-all"></th>
                        <th>Player</th>
                        <th>Horse</th>
                        <th class="cw-100 action">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                    <?php foreach ($data as $row) : ?>
                    <tr>
                        <td class="cw-45 checkbox"><input type="checkbox" name="row[]" value="<?= $row['playerid']."-".$row['horseid'] ?>"></td>
                        <td><?= $row['playerid'] ?></td>
                        <td><?= $row['horseid'] ?></td>
                        <td class="cw-100 action"><a href="<?= ROOT ?>table/edit/id"><input type="button" value="Editer"></a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="actions-container">
                <div>
                    <a href="<?= ROOT ?>table/add"><input type="button" name="add" value="Ajouter"></a>
                    <input type="submit" name="delete" value="Supprimer">
                </div>
                <div class="pages-container">
                    <a href="<?= ROOT ?>player/horses?page=1"><input <?= $current_page == 1 ? "class='active'" : "" ?> type="button" value="1"></a>
                    <?php $i = 2 ?>
                    <?php if($current_page - 2 > 1) : ?>
                        <?php $i = $current_page - 2 ?>
                        <p>...</p>
                    <?php endif; ?>
                    <?php if($last_page > 1) : ?>
                        <?php for ($i; $i<=$last_page; $i++) : ?>
                            <?php if($i >= $current_page + 3) : ?>
                                <?php if($current_page + 3 < $last_page) : ?>
                                    <p>...</p>
                                <?php endif; ?>
                                <a href="<?= ROOT ?>player/horses?page=<?= $last_page ?>">
                                    <input <?= $current_page == $last_page ? "class='active'" : "" ?> type="button" value="<?= $last_page ?>">
                                </a>
                                <?php break; ?>
                            <?php endif; ?>
                            <a href="<?= ROOT ?>player/horses?page=<?= $i ?>">
                                <input <?= $i == $current_page ? "class='active'" : "" ?> type="button" value="<?= $i ?>">
                            </a>
                        <?php endfor; ?>
                    <?php endif ?>
                </div>
            </div>
        </form>

    </section>
</main>

<script type="text/javascript">
    $('#select-all').click(function(event) {
        if(this.checked) {
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
</script>