<?php
$userManager = new UserManager();
?>

<div class="myAccount">
    <article class="description">
        <p><?= $user->getProfilImage() ?></p>
        <p><?= $user->getPseudo() ?></p>
        <p><?= "Inscrit il y a". $userManager->compareDate($user)["year"] ?></p>
        <p>BIBLIOTHEQUE</p>
        <p><?= $userManager->getNbBooks($user->getId())."livres" ?></p>
    </article>
    <form action="" method="post" class="infoAccount">
        <p>Vos informations personnelles</p>
        <p>Addresse email</p>
        <input type="text" name="email" value="<?= $user->getEmail() ?>">
        <p>Mot de passe</p>
        <input type="password" name="password" value="**********">
        <p>Pseudo</p>
        <input type="text" name="pseudo" value="<?= $user->getPseudo() ?>">
        <button class="submit">Enregistrer</button>
    </form>
    <article class="library">
        <div class="headerLibrary">
            <div class="imageBook">Image</div>
            <div class="title">Titre</div>
            <div class="author">Auteur</div>
            <div class="description">Description</div>
            <div class="disponibility">Disponibilité</div>
            <div class="action">Action</div>
        </div>
        <?php $library = $userManager->getLibrary($user->getId());
        foreach($library as $book){ ?>
            <div class="bookInLibrary">
                <div class="imageBook"><img src="<?= $book->getImage() ?>" alt=<?= $book->getTitle() ?>></div>
                <div class="title"><?= $book->getTitle() ?></div>
                <div class="author"><?= $book->getAuthor() ?></div>
                <div class="description"><?= $book->getDescription() ?></div>
                <div class="status"><?= $book->getStatus() ?></div>
                <div class="action"><button class="editBook">Editer</button><button class="deleteBook">Supprimer</button></div>
            </div>
        <?php } ?>
    </article>
</div>