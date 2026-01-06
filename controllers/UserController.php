<?php

class UserController{
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['log'])) {
            header("Location: index.php?action=showConnectionForm");
        }
    }
    /**
     * Affiche la vue messages.php avec les contacts et derniers messages
     * @return void
     */
    public function showAccount():void
    {
        $this->checkIfUserIsConnected();

        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($_SESSION['log']);

        $view = new View("Mon compte");
        $view->render("account",["user" => $user]);
    }
    public function showConnectionForm():void
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }
    public function showInscriptionForm():void
    {
        $view = new View("Inscription");
        $view->render("inscriptionForm");
    }
    public function registerUser():void
    {
        $userManager = new UserManager();
        $user= new User(["name" => DEFAULT_NAME, "pseudo" => $_POST['pseudo'], "password" => password_hash($_POST['password'], PASSWORD_BCRYPT), "profilImage" => DEFAULT_IMAGE_PROFIL, "email" => $_POST['email']]);
        $userManager->addUser($user);
        $user = $userManager->getUserByEmail($user->getEmail());

        $view = new View("Mon compte");
        $view->render("account",["user" => $user]);
    }
    public function connectUser():void
    {
        $userManager = new UserManager();
        $user= $userManager->getUserByEmail($_POST['log']);

        $_SESSION['log'] = $_POST['log'];

        $view = new View("Mon compte");
        $view->render("account",["user" => $user]);
    }
    public function disconnectUser():void
    {
        session_destroy();
        header("Location: index.php?action=home");
    }
    public function updateUser():void
    {
        $userManager = new UserManager();
        $user= $userManager->getUserByEmail($_SESSION['log']);
        $user->setEmail($_POST['log']);
        $_SESSION['log'] = $_POST['log'];
        $user->setPseudo($_POST['pseudo']);
        $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
        $userManager->updateUser($user);
        header("Location: index.php?action=showAccount");
    }
}