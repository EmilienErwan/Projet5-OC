<?php 

class BookManager extends AbstractEntity{
    /**
     * Récupère tous les livres diponibles
     * @return array
     */
    public function getBooksByStatus(): array{
        $bookObject = [];
        $query = "SELECT * FROM books WHERE status = true";
        $stmt = $this->pdo->query($query);
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($books as $book){
            $bookObject[] = new Book($book);
        }
        return $bookObject;
    }
    /**
     * Récupère les 4 derniers livres ajoutés
     * @return array
     */
    public function getBooksByAddedDate(): array{
        $bookObject = [];
        $query = "SELECT * FROM books WHERE status = true ORDER BY AddedDate DESC LIMIT 4";
        $stmt = $this->pdo->query($query);
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($books as $book){
            $bookObject[] = new Book($book);
        }
        return $bookObject;
    }
    /**
     * Récupère un livre par son id
     * @param int $bookId
     * @return Book|null
     */
    public function getBookById(int $bookId): ?Book {
        $query = "SELECT * FROM books WHERE id = ?";
        $stmt = $this->pdo->query( $query,[$bookId]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        if( $book ){
            return new Book($book);
        }
        return null;
    }
    /**
     * Récupère un livre aléatoire
     * @return Book|null
     */
    public function randomBook(): ?Book {
        $query = "SELECT * FROM books ORDER BY RAND() LIMIT 1";
        $stmt = $this->pdo->query($query);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        if($book){
            return new Book($book);
        }
        return null;
    }
    /**
     * Supprime un livre par son id
     * @param int $idBook
     * @return void
     */
    public function deleteBook(int $idBook): void{
        $query = "DELETE FROM books WHERE id = ?";
        $this->pdo->query( $query, [$idBook] );
    }
    /**
     * Modification d'un livre
     * @param $book
     * @return void
     */
    public function updateBook(Book $book): void {
        $query = "UPDATE books SET title = :title, author = :author, description = :description, status = :status, image = :image, idUser = :idUser WHERE id=".$book->getId()."";
        $this->pdo->query($query, ["title" => $book->getTitle(),"author" => $book->getAuthor(),"description" => $book->getDescription(),"status" => $book->getStatus(),"image" => $book->getImage(),"idUser" => $book->getIdUser()]);
    }
    /**
     * Ajoute un livre dans la bdd
     * @param $book
     * @return void
     */
    public function addBook(Book $book): void{
        $query = "INSERT INTO books (title,author,description,status,image,idUser,AddedDate) VALUES (:title,:author,:description,:status,:image,:idUser,Now())";
        $this->pdo->query( $query, ["title" => $book->getTitle(),"author" => $book->getAuthor(),"description" => $book->getDescription(),"status" => $book->getStatus(),"image" => $book->getImage(),"idUser" => $book->getIdUser()] );
    }
    public function bookStatus(bool $status): string {
        return $status ? "Disponible" : "Non dispo.";
    }
    public function searchBooks(string $search): array {
        $bookObject = [];
        $sql = "SELECT * FROM books WHERE title LIKE :search OR author LIKE :search OR description LIKE :search";
        $stmt = $this->pdo->query($sql, ["search" => "%".$search."%"]);
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($books as $book){
            $bookObject[] = new Book($book);
        }
        return $bookObject;
    }
    public function getLastInsertId(): int {
        $userId = $_SESSION['id'];
        $query = "SELECT id FROM books WHERE idUser = ? ORDER BY id DESC LIMIT 1";
        $stmt = $this->pdo->query($query, [$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['id'] : 0;
    }
}