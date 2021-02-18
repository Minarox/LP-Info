<form action="<?= APP_URL ?>/email/register" method="post">
    <input type="hidden" name="token_email" value="<?= $token ?>">
    <input type="submit" value="NTM" name="register">
</form>