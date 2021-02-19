<form action="<?= $uri ??= null ?>" method="post">
    <input type="hidden" name="token_email" value="<?= $token ??= null ?>">
    <input type="submit" value="Confirmer" name="account_verification">
</form>