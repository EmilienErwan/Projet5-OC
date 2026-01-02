<?php
$userManager = new UserManager();
$user = $params['user'];
?>

<div class="myAccount">
    <article class="description">
        <img src="<?= $user->getProfilImage() ?>" alt="<?= $user->getPseudo() ?>">
        <p><?= $user->getPseudo() ?></p>
        <p><?= "Inscrit il y a". $userManager->compareDate($user)["year"] ?></p>
        <p>BIBLIOTHEQUE</p>
        <p><?= $userManager->getNbBooks($user->getId())."livres" ?></p>
    </article>
    <form action="index.php?action=updateUser" method="post" class="infoAccount">
        <p>Vos informations personnelles</p>
        <label for="log">Addresse email</label>
        <input type="text" name="log" value="<?= $user->getEmail() ?>">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" value="<?= $user->getPassword() ?>">
        <label for="pseudo">Pseudo</label>
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