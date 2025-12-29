<?php

class UserController{
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=connectionForm.php");
        }
        exit();
    }
    /**
     * Affiche la vue messages.php avec les contacts et derniers messages
     * @return void
     */
    public function showAccount():void
    {
        $this->checkIfUserIsConnected();
        
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($_POST['email']);

        $view = new View("Mon compte");
        $view->render("account",["user" => $user]);
    }
}