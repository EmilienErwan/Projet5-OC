<?php
    /**
     * Affichage de Liste des livres à l'échange. 
     */
    $userManager = new UserManager();
    $books = $params['books'];
?>
<div class="exchangeBookLayout">
    <div class="exchangeBookHeader">
        <h1>Nos livres à l'échange</h1>
        <form action="index.php" method="GET">
            <input type="hidden" name="action" value="searchBooks">
            <input type="text" name="search" class="searchBar" placeholder= "&#128269; Rechercher un livre">
        </form>
    </div>
    <div class="exchangeBookList">
        <?php foreach($books as $book) {?>
            <article class="exchangeBook">
                <a class="info" href="index.php?action=showBook&id=<?= $book->getId() ?>"><img src=<?= $book->getImage() ?>></a>
                <h2><?= $book->getTitle() ?></h2>
                <p><?= $book->getAuthor() ?></p>
                <em><?= "Vendu par : " . $userManager->getUserById($book->getIdUser())->getPseudo() ?></em>
            </article>
        <?php } ?>
    </div>
</div>