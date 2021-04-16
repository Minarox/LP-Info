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
                        <th class="cw-90">Id</th>
                        <th>Name</th>
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
                        <td class="cw-45 checkbox"><input type="checkbox" name="row[]" value="<?= $row['id'] ?>"></td>
                        <td class="cw-90"><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
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
                <div>
                    <input type="button" value="Page précedente">
                    <input type="button" value="Page suivante">
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