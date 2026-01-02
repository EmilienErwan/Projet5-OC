<?php
    /**
     * Affichage de Liste des livres à l'échange. 
     */
    $userManager = new UserManager();
    $book = $params['book'];
?>

<input type="text" class="searchBar" placeholder="Rechercher un livre">
<div class="articleList">
        <article class="article">
            <a class="info" href="index.php?action=showBook&id=<?= $book->getId() ?>"><img src=<?= $book->getImage() ?>></a>
            <h2><?= $book->getTitle() ?></h2>
            <p><?= "par ". $book->getAuthor() ?></p>
            <p><?= "Description ". $book->getDescription() ?></p>
            <p><?= "Propriétaire " . $userManager->getUserById($book->getIdUser())->getPseudo() ?></p>
            <button class="messages">Envoyer un message</button>
        </article>
</div>