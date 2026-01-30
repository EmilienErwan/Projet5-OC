<?php

class BookController{
    public function showAddBook():void
    {
        $view = new View("Ajouter un livre");
        $view->render("addBook");
    }
    public function showExchangeBooks():void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();
        if(!$books){
            throw new Exception("Aucun livre disponible à l'échange.");
        }
        $view = new View("Nos livres à l'échange");
        $view->render("exchangeBooks",["books" => $books,"search" => $_GET['search'] ?? ""]);
    }
    public function showBook():void
    {
        $bookManager = new BookManager();
        if(!isset($_GET['id'])){
            throw new Exception("Livre introuvable.");
        }
        $book = $bookManager->getBookById($_GET['id']);
        if(!$book){
            throw new Exception("Livre introuvable.");
        }
        $view = new View("Détail du livre");
        $view->render("detailBook",["book" => $book]);
    }
    public function deleteBook(): void {
        if(!isset($_GET['id'])){
            throw new Exception("Livre introuvable.");
        }
        $bookID = $_GET['id'];
        $bookManager = new BookManager();
        $userManager = new UserManager();
        $book = $bookManager->getBookById($bookID);
        if(!$book){
            throw new Exception("Livre introuvable.");
        }
        $bookManager->deleteBook($bookID);
        $userManager->updateLibrary($_SESSION['id'],$bookID, "delete");
        header("Location: index.php?action=showAccount");
    }
    public function editBook(): void {
        if(!isset($_GET['id'])){
            throw new Exception("Livre introuvable.");
        }
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($_GET['id']);
        if(!$book){
            throw new Exception("Livre introuvable.");
        }
        $view = new View("Édition du livre");
        $view->render("editBook",["book" => $book]);
    }
    public function updateBook(): void {
        if(!isset($_GET['id'])){
            throw new Exception("Livre introuvable.");
        }
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($_GET['id']);
        if(!$book){
            throw new Exception("Livre introuvable.");
        }
        $book->setTitle($_POST['title']);
        $book->setAuthor($_POST['author']);
        $book->setDescription($_POST['description']);
        $book->setStatus($_POST['status']);
        $bookManager->updateBook($book);
        header("Location: index.php?action=showAccount");
    }
    public function addBook(): void{
        $imageManager = new ImageManager();
        $imageManager->saveImage("bookImage", null);
        $book = new Book([
            "title" => $_POST['title'],
            "author" => $_POST['author'],
            "description" => $_POST['description'],
            "status" => $_POST['status'],
            "image" => $_POST['image'] ?? DEFAULT_IMAGE_BOOK,
            "idUser" => $_SESSION['id']
        ]);
        $bookManager = new BookManager();
        $bookManager->addBook($book);
        $userManager = new UserManager();
        $lastBook = $bookManager->getLastInsertId();
        $userManager->updateLibrary($_SESSION['id'], $lastBook, "add");
        header("Location: index.php?action=showAccount");
    }
    public function searchBooks(): void{
        if(!isset($_GET['search']) || empty(trim($_GET['search']))){
            throw new Exception("Veuillez entrer un terme de recherche.");
        }
        $query = trim($_GET['search']);
        $bookManager = new BookManager();
        $books = $bookManager->searchBooks($query);
        if(!$books){
            $this->showExchangeBooks();
            return;
        }
        $view = new View("Résultats de la recherche");
        $view->render("exchangeBooks",["books" => $books]);
    }
}