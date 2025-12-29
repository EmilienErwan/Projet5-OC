<?php 

class UserManager extends AbstractEntity{
    /**
     * Recupère l'utilisateur par le pseudo
     * @param string $pseudo
     * @return User|null
     */
    public function getUser(string $pseudo): ?User {
        $query = "SELECT * FROM user WHERE pseudo = ?";
        $result = $this->pdo->query($query, [$pseudo]);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return new User($user);
        }
        return null;
    }
    /**
     * Retourne une information sur l'utilisateur
     * @param int $id
     * @param string $table
     */
    public function getUserInfo(int $id, string $table): ?string{
        $query = "SELECT $table FROM user WHERE id = ?";
        $result = $this->pdo->query($query,[$id]);
        $userInfo = $result->fetch(PDO::FETCH_ASSOC);
        if($userInfo !== null){
            return $userInfo;
        }
        return null;
    }
    /**
     * Modifie l'utilisateur
     * @param User $user
     * @return void
     */
    public function updateUser(User $user): void {
        $query = "UPDATE users SET name = :name, pseudo = :pseudo, password = :password, library = :library ";
        $this->pdo->query($query, ["name" => $user->getName(),"pseudo" => $user->getPseudo(),"password" => $user->getPassword(),"library" => $user->getLibrary()]);
    }
    /**
     * Récupère et modifie la bibliothèque
     * @param int $userId
     * @param array $data
     * @return void
     */
    public function updateLibrary(int $userId, array $data){
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
        return count($libraryArray);
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