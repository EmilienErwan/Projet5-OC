<?php
$book = $params['book'];
?>
<div class = "headerEditBook">
    <h1>Modifier les informations</h1>
</div>
<div class ="editBookLayout">
    <form action="index.php?action=updateBook&id=<?= $book->getId() ?>" method="post" class="editBookForm">
        <div class ="bookImage">
            <label for="image">Photo</label>
            <img src="<?= htmlspecialchars($book->getImage()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>">
            <a href="">Modifier la photo</a>
        </div>
        <div class ="bookInfo">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($book->getTitle()) ?>" required>
            
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" value="<?= htmlspecialchars($book->getAuthor()) ?>" required>
            
            <label for="description">Commentaire</label>
            <textarea name="description" id="description" class="description" required><?= htmlspecialchars($book->getDescription()) ?></textarea>
            
            <label for="status">Statut :</label>
            <select name="status" id="status" required>
                <option value="true" <?= $book->getStatus() ? 'selected' : '' ?>>Disponible</option>
                <option value="false" <?= !$book->getStatus() ? 'selected' : '' ?>>Indisponible</option>
            </select>
            <button type="submit" class="submit">Valider</button>
        </div>
    </form>
</div>