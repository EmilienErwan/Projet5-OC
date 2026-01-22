<?php
    /**
     * Affichage de Liste des livres à l'échange. 
     */
    $userManager = new UserManager();
    $book = $params['book'];
    $user = $userManager->getUserById($book->getIdUser())
?>

<div class="articleList">
        <article class="article">
            <div class="bookImage">
                <a class="info" href="index.php?action=showBook&id=<?= $book->getId() ?>"><img src=<?= $book->getImage() ?>></a>
            </div>
            <div class="bookInfo">
                <h2><?= $book->getTitle() ?></h2>
                <p class="author"><?= "par ". $book->getAuthor() ?></p>
                <p class="bar"> </p>
                <h4>Description</h4>
                <p class="description"><?= $book->getDescription() ?></p>
                <h4>Propriétaire</h4>
                <div class="owner">
                    <img src= "<?= $user->getProfilImage() ?>">
                    <span><?= $user->getPseudo() ?></span>
                </div>
                <button class="messages" ><a href="index.php?action=showMessages&idUser=<?= $user->getId() ?>">Envoyer un message</a></button>
            </div>
        </article>
</div>