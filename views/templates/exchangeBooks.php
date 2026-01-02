<?php
    /**
     * Affichage de Liste des livres à l'échange. 
     */
    $userManager = new UserManager();
    $books = $params['books'];
?>

<input type="text" class="searchBar" placeholder="Rechercher un livre">
<div class="articleList">
    <?php foreach($books as $book) {?>
        <article class="article">
            <a class="info" href="index.php?action=showBook&id=<?= $book->getId() ?>"><img src=<?= $book->getImage() ?>></a>
            <h2><?= $book->getTitle() ?></h2>
            <p><?= $book->getAuthor() ?></p>
            <p><?= "Vendu par :" . $userManager->getUserById($book->getIdUser())->getPseudo() ?></p>
        </article>
    <?php } ?>
</div>