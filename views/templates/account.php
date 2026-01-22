<?php
$userManager = new UserManager();
$bookManager = new BookManager();
$user = $params['user'];
?>

<div class="accountLayout">
    <h1>Mon compte</h1>
    <div class="accountHeader">
        <div class="description">
            <div class="descriptionImage">
                <img src="<?= $user->getProfilImage() ?>" alt="<?= $user->getPseudo() ?>">
                <a href="index.php?action=editProfilImage">Modifier</a>
            </div>
            <div class="descriptionInfo">
                <p><?= $user->getPseudo() ?></p>
                <p><?= "Inscrit il y a". $userManager->compareDate($user)["year"] ?></p>
                <p>BIBLIOTHEQUE</p>
                <p><?= $userManager->getNbBooks($user->getId())."livres" ?></p>
            </div>
        </div>
        <div class="infoAccount">
            <form action="index.php?action=updateUser" method="post">
                <p>Vos informations personnelles</p>
                <label for="log">Addresse email</label>
                <input type="text" name="log" value="<?= $user->getEmail() ?>">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" value="<?= $user->getPassword() ?>">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" value="<?= $user->getPseudo() ?>">
                <button class="submit">Enregistrer</button>
            </form>
        </div>
    </div>
    <div class="library">
        <div class="headerLibrary libraryGrid">
            <div class="imageBook">Image</div>
            <div class="title">Titre</div>
            <div class="author">Auteur</div>
            <div class="accountDescription">Description</div>
            <div class="disponibility">Disponibilité</div>
            <div class="action">Action</div>
        </div>
        <?php $library = $userManager->getLibrary($user->getId());
        if($library === null){
            echo "<p>Votre bibliothèque est vide</p>";
        }else{ ?>
            <div class="libraryList">
                <?php foreach($library as $book){ 
                    if($book->getId()%2 == 0){ ?>
                        <div class="bookInLibraryElse libraryGrid">
                    <?php }else{ ?>
                        <div class="bookInLibrary libraryGrid">
                    <?php } ?>
                            <div class="imageBook"><img src="<?= $book->getImage() ?>" alt=<?= $book->getTitle() ?>></div>
                            <div class="title"><?= $book->getTitle() ?></div>
                            <div class="author"><?= $book->getAuthor() ?></div>
                            <div class="accountDescription"><?= $book->getDescription() ?></div>
                            <div class="status"><?= $bookManager->bookStatus($book->getStatus()) ?></div>
                            <div class="actionEdit"><a href="index.php?action=showEditBook&id=<?= $book->getId() ?>">Editer</a></div>
                            <div class="actionDelete"><a href="index.php?action=deleteBook&id=<?= $book->getId() ?>">Supprimer</a></div>
                        </div>
                    <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>