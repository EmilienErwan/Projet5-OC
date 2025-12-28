<?php

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
                <a href="index.php">Accueil</a>
                <a href="exchangeBook.php">Nos livres à l'échange</a>
                <a href="messages.php">Messagerie</a>
                <a href="account.php">Mon compte</a>
                <a href="connectionForm.php">Connexion</a>
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