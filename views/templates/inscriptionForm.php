<?php
    /**
     * Template pour afficher le formulaire de connexion.
     */
?>

<div class="inscription-form">
    <div class="formWrapper">
        <form action="index.php?action=registerUser" method="post" class="">
            <h2>Inscription</h2>
            <div class="formGrid">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" required>
                <label for="email">Addresse email</label>
                <input type="text" name="email" id="email" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <button class="submit">S'inscrire</button>
            </div>
            <p>Déjà inscrit ? <a href="index.php?action=showConnectionForm">Connectez-vous</a></p>
        </form>
    </div>
    <img src="./uploads/images/logos/connection_image.png" alt="Image d'inscription">
</div>