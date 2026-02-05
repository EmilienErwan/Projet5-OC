<?php
    /**
     * Affichage de Liste des livres à l'échange. 
     */
    $userManager = new UserManager();
    $book = $params['book'];
    $user = $userManager->getUserById($book->getIdUser());
    $verif = true;
    if(!isset($_SESSION['id'])){
        $verif = null;
    }
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
                    <a href="index.php?action=showAccount&id=<?= $user->getId() ?>">
                        <img src= "<?= $user->getProfilImage() ?>">
                        <span><?= $user->getPseudo() ?></span>
                    </a>
                </div>
                <?php if( $verif === null ) { ?>
                    <button class="messages" ><a href="index.php?action=showConnectionForm">Envoyer un message</a></button>
                <?php } else {
                    if($_SESSION['id'] !== $user->getId()) { ?>
                    <a href="index.php?action=showMessages&idUser=<?= $user->getId() ?>"><button class="messages" >Envoyer un message</button></a>
                <?php }} ?>
            </div>
        </article>
</div>