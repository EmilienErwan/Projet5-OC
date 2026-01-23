<?php 

class UserManager extends AbstractEntity{
    /**
     * Recupère l'utilisateur par le pseudo
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): ?User {
        $query = "SELECT * FROM users WHERE email = ?";
        $result = $this->pdo->query($query, [$email]);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return new User($user);
        }
        return null;
    }
    /**
     * Recupère l'utilisateur par son id
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User {
        $query = "SELECT * FROM users WHERE id = ?";
        $result = $this->pdo->query($query, [$id]);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return new User($user);
        }
        return null;
    }
    /**
     * Modifie l'utilisateur
     * @param User $user
     * @return void
     */
    public function updateUser(User $user): void {
        $query = "UPDATE users SET name = :name, pseudo = :pseudo, password = :password, library = :library, email = :email, profilImage = :profilImage WHERE id =".$user->getId()."";
        $this->pdo->query($query, ["name" => $user->getName(),"pseudo" => $user->getPseudo(),"password" => $user->getPassword(),"library" => $user->getLibrary(), "email" => $user->getEmail(),"profilImage" => $user->getProfilImage()]);
    }
    /**
     * Récupère et modifie la bibliothèque
     * @param int $userId
     * @param int $bookId
     * @param string $choice
     * @return void
     */
    public function updateLibrary(int $userId, int $bookId, string $choice){
        $user = $this->getUserById($userId);
        $data = json_decode($user->getLibrary());
        $allowed_choice = ['add','delete'];

        if(!in_array($choice,$allowed_choice)){
            throw new Exception("Action non réalisable");
        }
        if($choice == "add"){
            $data [] = (int)$bookId;
        }else{
            $index = array_search((int)$bookId,$data);
            if($index !== false){
                unset($data[$index]);
            }
        }
        $datas = json_encode($data);
        $query = "UPDATE users SET library= ? WHERE id = ?";
        $this->pdo->query($query, [$datas, $userId]);
    }
    /**
     * Retourne le nombre de livres dans la bibliotheque
     * @param int $userId
     * @return int
     */
    public function getNbBooks(int $userId): int{
        $query = "SELECT library FROM users WHERE id = ?";
        $result = $this->pdo->query($query, [$userId]);
        $library = $result->fetch(PDO::FETCH_ASSOC);
        $libraryArray = json_decode($library['library'], true);
        return is_array($libraryArray) ? count($libraryArray) : 0;
    }
    /**
     * Retourne la bibliothèque d'un utilisateur
     * @param int $userId
     * @return array
     */
    public function getLibrary(int $userId): array{
        $query = "SELECT library FROM users WHERE id = ?";
        $result = $this->pdo->query($query, [$userId]);
        $library = $result->fetch(PDO::FETCH_ASSOC);
        $idBooks = json_decode($library['library'], true);
        $bookManager = new BookManager();
        $books = [];
        if(!is_array($idBooks)){
            return $books;
        }
        foreach($idBooks as $idBook){
            $books[] = $bookManager->getBookById($idBook);
        }
        return $books;
    }
    /**
     * Supprime un utilisateur
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id){
        $query = "DELETE FROM users WHERE id= ?";
        $this->pdo->query($query, [$id]);
    }
    /**
     * Ajoute un utilisateur
     * @param User $user
     * @return void
     */
    public function addUser(User $user): void {
        $query = "INSERT INTO users (name,pseudo,password,library,inscriptionDate,profilImage,email) VALUES (:name, :pseudo, :password, :library, NOW(), ".DEFAULT_IMAGE_PROFIL.", :email)";
        $this->pdo->query($query, ["name" => $user->getName(), "pseudo" => $user->getPseudo(), "password" => $user->getPassword(), "library" => $user->getLibrary(), "email" => $user->getEmail()]);
    }
    /**
     * Compare la date d'inscription avec la date actuelle et retourne la différence
     * @param User $user
     * @return array
     */
    public function compareDate(User $user) : array{
        $inscriptionDate = $user->getInscriptionDate();
        $now = new DateTime();
        $diff = $inscriptionDate->diff($now);
        return ["year" => $diff->y, "month" => $diff->m, "day" => $diff->d];
    }
}