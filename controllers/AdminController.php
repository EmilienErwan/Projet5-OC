<?php

class AdminController{
    /**
     * Affiche la vue messages.php avec les contacts et derniers messages
     * @return void
     */
    public function showHome():void
    {
        if(isset($_SESSION['log'])) {
            $connected = "disconnectUser";
        } else {
            $connected = "showConnectionForm";
        }
        $view = new View("Accueil");
        $view->render("home", ['connected' => $connected]);
    }
}