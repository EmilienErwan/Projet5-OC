<?php
$connected = $params['connected'];
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
                    <a href="index.php?action=home">Accueil</a>
                    <a href="index.php?action=showExchangeBooks">Nos livres à l'échange</a>
                </div>
                <div class="rightMenu">
                    <a href="index.php?action=showMessages">Messagerie</a>
                    <a href="index.php?action=showAccount">Mon compte</a>
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
            <p><a href="">Politique de confidentialité</a><a href="">Mentions légales</a>Tom Troc</p>
        </footer>
    </body>
</html>