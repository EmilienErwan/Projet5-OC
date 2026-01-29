<div class = "headerEditBook">
    <h1>Ajouter un livre</h1>
</div>
<div class ="editBookLayout">
    <form action="index.php?action=addBook" method="post" class="editBookForm">
        <div class ="bookImage">
            <label for="image">Photo</label>
            <img src="<?= DEFAULT_IMAGE_BOOK ?>" alt="Image par défaut">
        </div>
        <div class ="bookInfo">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="" required>
            
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" value="" required>
            
            <label for="description">Commentaire</label>
            <textarea name="description" id="description" class="description" required></textarea>
            
            <label for="status">Statut :</label>
            <select name="status" id="status" required>
                <option value="true">Disponible</option>
                <option value="false">Indisponible</option>
            </select>
            <button type="submit" class="submit">Valider</button>
        </div>
    </form>
</div>