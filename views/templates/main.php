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
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="logo">
                    <a href="index.php?action=home"><img src="./uploads/images/logos/logo.png" alt="Logo Tom Troc"></a>
                </div>
                <div class="leftMenu">
                    <a href="index.php?action=home" class="<?= ($_GET['action'] ?? 'home') === 'home' ? 'active' : '' ?>">Accueil</a>
                    <a href="index.php?action=showExchangeBooks" class="<?= ($_GET['action'] ?? '') === 'showExchangeBooks' ? 'active' : '' ?>">Nos livres à l'échange</a>
                </div>
                <div class="rightMenu">
                    <a href="index.php?action=showMessages" class="<?= ($_GET['action'] ?? '') === 'showMessages' ? 'active' : '' ?>">Messagerie</a>
                    <a href="index.php?action=showAccount" class="<?= ($_GET['action'] ?? '') === 'showAccount' ? 'active' : '' ?>">Mon compte</a>
                    <?php if($connected === "disconnectUser"){ ?>
                        <a href="index.php?action=disconnectUser">Déconnexion</a>
                    <?php } else { ?>
                        <a href="index.php?action=showConnectionForm">Connexion</a>
                    <?php } ?>
                </div>
            </nav>
        </header>
        <main>
            <?=  $content ?>
        </main>
        <footer>
            <p>Politique de confidentialité Mentions légales Tom Troc</p>
        </footer>
    </body>
</html>