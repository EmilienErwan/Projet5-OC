<?php

class AdminController{
    /**
     * Affiche la vue messages.php avec les contacts et derniers messages
     * @return void
     */
    public function showHome():void
    {
        $view = new View("Accueil");
        $view->render("home");
    }
}