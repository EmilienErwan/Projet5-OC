<?php
class ImageManager extends AbstractEntity{
    public function saveImage(string $dirUpload, int $id): void{
        $allowedDirName = ["bookImage","userImage"];
        if(!in_array($dirUpload,$allowedDirName)){
            throw new Exception("Nom de dossier incorrect");
        }
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Aucune image n'a été chargé");
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            throw new Exception("Format d'image non autorisé");
        }
        $uploadDir = dirname(__DIR__) . "/uploads/images/". $dirUpload."/";

        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('img_', true) . '.' . $extension;

        move_uploaded_file($_FILES['image']['tmp_name'],$uploadDir . $filename);

        $imagePath = "./uploads/images/". $dirUpload."/". $filename;
        
        if($dirUpload == "bookImage"){
            $bookManager = new BookManager();
            $book = $bookManager->getBookById($id);
            $book->setImage($imagePath);
            $bookManager->updateBook($book);
        }else{
            $userManager = new UserManager();
            $user = $userManager->getUserById($id);
            $user->setProfilImage($imagePath);
            $userManager->updateUser($user);
        }
    }
}