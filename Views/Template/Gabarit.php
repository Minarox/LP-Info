<!-- Page "template" utilisée sur la totalité du site -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta pour l'encodage et l'affichage mobile -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- Titre de la page -->
    <title>MVC PHP</title>
    <!-- CSS -->
    <link rel="icon" href="<?php echo $A_result['path'].$A_result['static']; ?>images/favicon.ico">
    <link rel="stylesheet" href="<?php echo $A_result['path'].$A_result['static']; ?>css/style.css">
</head>
<body>
<!-- Haut de page -->
<header>
    <!-- Menu -->
    <nav>
        <ul>
            <!-- Logo -->
            <li><a href="index.php"><img src="<?php echo $A_result['path'].$A_result['static']; ?>images/logo.png" alt="Logo PHP."></a></li>
            <li><hr></li>
            <!-- Navigation -->
            <li><a href="<?php echo $A_result['path']; ?>index.php">Accueil</a></li>
            <li id="hello-world"><a href="<?php echo $A_result['path']; ?>hello">"Hello World!"</a></li>
            <li><a href="<?php echo $A_result['path']; ?>students">Étudiants</a></li>
            <li id="formations"><a href="<?php echo $A_result['path']; ?>formations">Formations</a></li>
            <li><a href="<?php echo $A_result['path']; ?>groups">Groupes</a></li>
        </ul>
    </nav>
</header>
<!-- Contenu de la page -->
<main>
    <?php echo $A_result['body']; ?>
</main>
</body>
</html>