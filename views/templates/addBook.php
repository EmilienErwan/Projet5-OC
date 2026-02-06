<script src="/Projet5/tomTroc/js/dropzone.js"></script>
<div class = "headerEditBook">
    <h1>Ajouter un livre</h1>
</div>
<div class ="editBookLayout">
    <form action="index.php?action=addBook" method="post" class="editBookForm" enctype="multipart/form-data">
        <div class ="bookImage">
            <p>Photo</p>
            <div class="dropzone" id="dropzone">
                <p>Déposez l’image ici ou cliquez</p>
                <input type="file" name="image" id="imageInput" hidden>
            </div>

            <img id="previewImage" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" style="display:none; margin-top:10px;" alt="Image de prévisualisation">
        </div>
        <div class ="bookInfo">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" value="" required>
            
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" value="" required>
            
            <label for="description">Commentaire</label>
            <textarea name="description" id="description" class="description" required></textarea>
            
            <label for="status">Statut :</label>
            <select name="status" id="status">
                <option value="true">Disponible</option>
                <option value="false">Indisponible</option>
            </select>
            <button type="submit" class="submit">Valider</button>
        </div>
    </form>
</div>