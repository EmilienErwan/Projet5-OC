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
     * @param int $id
     * @param array $data
     * @return void
     */
    public function updateLibrary(int $id, array $data){
        $datas = json_encode($data);
        $query = "UPDATE users SET library= ? WHERE id = ?";
        $this->pdo->query($query, [$datas, $id]);
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
        $query = "INSERT INTO users (name = :name, pseudo=:pseudo, password=:password, library=:library";
        $this->pdo->query($query, ["name" => $user->getName(), "pseudo" => $user->getPseudo(), "password" => $user->getPassword(), "library" => $user->getLibrary()]);
    }
}