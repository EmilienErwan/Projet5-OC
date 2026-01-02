<?php
if(isset($_SESSION['log'])) {
    $connected = "disconnectUser";
} else {
    $connected = "showConnectionForm";
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="" content="">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <header>
            <nav>
                <a href="index.php?action=home">Accueil</a>
                <a href="index.php?action=showExchangeBooks">Nos livres à l'échange</a>
                <a href="index.php?action=showMessages">Messagerie</a>
                <a href="index.php?action=showAccount">Mon compte</a>
                <?php if($connected === "disconnectUser"){ ?>
                    <a href="index.php?action=disconnectUser">Déconnexion</a>
                <?php } else { ?>
                    <a href="index.php?action=showConnectionForm">Connexion</a>
                <?php } ?>
            </nav>
        </header>
        <main>
            <?=  $content ?>
        </main>
        <footer>
            <p><a href="">Politique de confidentialité</a><a href="">Mentions légales</a>Tom Troc</p>
        </footer>
    </body>
</html>