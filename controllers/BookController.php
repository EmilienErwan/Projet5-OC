<?php

class BookController{
    public function showExchangeBooks():void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getBooksByStatus();

        $view = new View("Nos livres à l'échange");
        $view->render("exchangeBooks",["books" => $books]);
    }
}