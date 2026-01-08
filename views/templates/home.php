<?php
    /**
     * Affichage de la page d'accueil.
     */
    $bookManager = new BookManager();
    $randomBook = $bookManager->randomBook();
    $userManager = new UserManager();
?>

<h1>Rejoignez nos lecteurs passionnés</h1>
<p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres</p>
<button><a href="index.php?action=showExchangeBooks">Découvrir</a></button>
<img src="<?= $randomBook->getImage() ?>" alt="<?= $randomBook->getTitle() ?>">
<?=  $userManager->getUserById($randomBook->getIdUser())->getPseudo() ?>
<h1>Les derniers livres ajoutés</h1>
<div class="lastBooks">
    <?php 
    $lastBooks = $bookManager->getBooksByAddedDate();
    foreach($lastBooks as $book){ ?>
        <a href="index.php?action=showBook&id=<?= $book->getId() ?>"><article class="bookCard">
            <img src="<?= $book->getImage() ?>" alt="<?= $book->getTitle() ?>">
            <h2><?= $book->getTitle() ?></h2>
            <h3>Par <?= $book->getAuthor() ?></h3>
            <p>Ajouté par <?= $userManager->getUserById($book->getIdUser())->getPseudo() ?></p>
        </article></a>
    <?php } ?>
</div>
<button><a href="index.php?action=showExchangeBooks">Voir tous les livres</a></button>
<h1>Comment ça marche ?</h1>
<div class="steps">
    <div class="step">
        <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
    </div>
    <div class="step">
        <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
    </div>
    <div class="step">
        <p>Parcourez les livres disponibles chez d'autres membres.</p>
    </div>
    <div class="step">
        <p>Proposez un échange avec d'autres passionnés de lecture.</p>
    </div>
</div>
<button><a href="index.php?action=showExchangeBooks">Voir tous les livres</a></button>
<h1>Nos valeurs</h1>
<p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
</br>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. 
</br>Nous sommes passionés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
<em>L'équipe Tom Troc</em>