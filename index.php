<?php

require_once("config/autoload.php");
require_once("config/config.php");

try {
        switch ($_GET['action'] ?? 'home') {

            case 'showAccount':
                $controller = new UserController();
                $controller->showAccount();
                break;
                
            case 'showMessages':
                $controller = new MessageController();
                $controller->showMessages();
                break;
            
            case 'sendMessage':
                $controller = new MessageController();
                $controller->sendMessage();
                break;

            case 'showConnectionForm':
                $controller = new UserController();
                $controller->showConnectionForm();
                break;

            case 'showExchangeBooks':
                $controller = new BookController();
                $controller->showExchangeBooks();
                break;
                
            case 'searchBooks':
                $controller = new BookController();
                $controller->searchBooks();
                break;

            case 'addBook':
                $controller = new BookController();
                $controller->addBook();
                break;

            case 'showAddBook':
                $controller = new BookController();
                $controller->showAddBook();
                break;

            case 'showBook':
                $controller = new BookController();
                $controller->showBook();
                break;

            case 'deleteBook':
                $controller = new BookController();
                $controller->deleteBook();
                break;

            case 'showEditBook':
                $controller = new BookController();
                $controller->editBook();
                break;

            case 'updateBook':
                $controller = new BookController();
                $controller->updateBook();
                break;
            
            case 'editBookImage':
                $controller = new AdminController();
                $controller->updateBookImage();
                break;

            case 'connectUser':
                $controller = new UserController();
                $controller->connectUser();
                break;

            case 'showInscriptionForm':
                $controller = new UserController();
                $controller->showInscriptionForm();
                break;

            case 'registerUser':
                $controller = new UserController();
                $controller->registerUser();
                break;

            case 'updateUser':
                $controller = new UserController();
                $controller->updateUser();
                break;

            case 'disconnectUser':
                $controller = new UserController();
                $controller->disconnectUser();
                break;

            case 'editProfilImage':
                $controller = new AdminController();
                $controller->updateProfilImage();
                break;
                
            default:
                $controller = new AdminController();
                $controller->showHome();
                break;
        }
} catch (Exception $e) {
    echo "erreur". $e->getMessage() ."erreur";
}