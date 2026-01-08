<?php

class BookController{
    public function showExchangeBooks():void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getBooksByStatus();
        if(!$books){
            throw new Exception("Aucun livre disponible à l'échange.");
        }
        $view = new View("Nos livres à l'échange");
        $view->render("exchangeBooks",["books" => $books]);
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
}