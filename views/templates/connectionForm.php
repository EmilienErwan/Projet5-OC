<?php
    /**
     * Template pour afficher le formulaire de connexion.
     */
    if(isset($_GET['error']) && $_GET['error'] == 1){
        $error = "<p class='errorMessage'>* Email ou mot de passe incorrect</p>";
    }
?>

<div class="connection-form">
    <div class="formWrapper">
        <form action="index.php?action=connectUser" method="post" class="">
            <?= $error ?? "" ?>
            <h2>Connexion</h2>
            <div class="formGrid">
                <label for="log">Addresse email</label>
                <input type="text" name="log" id="log" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <button class="submit">Se connecter</button>
            </div>
            <p>Pas encore de compte ? <a href="index.php?action=showInscriptionForm">Inscrivez-vous</a></p>
        </form>
    </div>
    <img src="./uploads/images/logos/connection_image.png" alt="Image de connexion">
</div>