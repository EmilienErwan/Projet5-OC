<?php

class AdminController{
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['email'])) {
            header("Location: index.php?action=showConnectionForm");
        }
    }
    /**
     * Affiche la vue messages.php avec les contacts et derniers messages
     * @return void
     */
    public function showHome():void
    {
        $view = new View("Accueil");
        $view->render("home");
    }
    public function updateProfilImage() : void {
        $this->checkIfUserIsConnected();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $userId = $_SESSION['id'];

            $imageManager = new ImageManager();
            $imageManager->saveImage('userImage',$userId);
            header("Location: index.php?action=showAccount");
        }
        $view = new View("Modifier l'image");
        $view->render("editProfilImage");
    }
    public function updateBookImage(): void {
        if(!isset($_GET['id'])){
            throw new Exception("Livre inexistant");
        }

        $bookId = (int)$_GET['id'];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $imageManager = new ImageManager();
            $imageManager->saveImage('bookImage', $bookId);
            header("Location: index.php?action=showEditBook&id=" . $bookId);
        }

        $view = new View("Modifier l'image");
        $view->render('editBookImage', ['bookId' => $bookId]);
    }


}