<?php
    
    // En fonction des routes utilisées, il est possible d'avoir besoin de la session ; on la démarre dans tous les cas. 
    session_start();

    // Ici on met les constantes utiles, 
    // les données de connexions à la bdd
    // et tout ce qui sert à configurer. 

    define('TEMPLATE_VIEW_PATH', './views/templates/'); // Le chemin vers les templates de vues.
    define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php'); // Le chemin vers le template principal.
    define('DEFAULT_IMAGE_PROFIL', "'./uploads/images/userImage/default_profil_image.png'"); // Le chemin vers l'image par défaut du profil.
    define('DEFAULT_IMAGE_BOOK', "'./uploads/images/userImage/default_book_image.jpg'"); // Le chemin vers l'image par défaut du profil.
    define('DEFAULT_NAME', 'Utilisateur Tom Troc'); // Le nom par défaut d'un utilisateur.

$envPath = __DIR__ . '/../.env';

if (!file_exists($envPath)) {
    throw new Exception('.env introuvable');
}

$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    if (str_starts_with(trim($line), '#')) {
        continue;
    }

    [$key, $value] = explode('=', $line, 2);
    $_ENV[trim($key)] = trim($value);
}



