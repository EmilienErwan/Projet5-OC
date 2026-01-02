<?php

class BookController{
    public function showExchangeBooks():void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getBooksByStatus();

        $view = new View("Nos livres à l'échange");
        $view->render("exchangeBooks",["books" => $books]);
    }
    public function showBook():void
    {
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($_GET['id']);

        $view = new View("Détail du livre");
        $view->render("detailBook",["book" => $book]);
    }
}