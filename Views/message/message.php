<?php if (isset($message_error)) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?= $message_error ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($message_success)) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?= $message_success ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>