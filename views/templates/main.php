<?php
$messageManager = new MessageManager();
if(isset($_SESSION['email'])) {
    $connected = "disconnectUser";
    $countMessage = "(".$messageManager->countNewMessages($_SESSION['id']).")";
} else {
    $countMessage = "";
    $connected = "showConnectionForm";
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <a href="index.php?action=showMessages" class="<?= ($_GET['action'] ?? '') === 'showMessages' ? 'active' : '' ?>">Messagerie<?= $countMessage ?></a>
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
            <div class="footerContent">
                <p>Politique de confidentialité</p>
                <p>Mentions légales</p>
                <p>Tom Troc</p>
                <img src="./uploads/images/logos/logo_footer.png" alt="Logo Tom Troc">
            </div>
        </footer>
    </body>
</html>