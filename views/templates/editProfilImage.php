<link rel="stylesheet" href="/Projet5/tomTroc/css/style.css">
<script src="/Projet5/tomTroc/js/dropzone.js"></script>
<a href="index.php?action=showAccount">< Retour</a>
<div class="editBookImage">
    <h2>Modifier l’image de profil</h2>
    <form action="index.php?action=editProfilImage" method="POST" enctype="multipart/form-data">

        <div class="dropzone" id="dropzone">
            <p>Déposez l’image ici ou cliquez</p>
            <input type="file" name="image" id="imageInput" hidden>
        </div>

        <img id="previewImage" style="display:none; max-width:200px; margin-top:10px;">

        <button type="submit">Valider</button>
    </form>
</div>
