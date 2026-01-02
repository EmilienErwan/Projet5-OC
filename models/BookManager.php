<?php 

class BookManager extends AbstractEntity{
    /**
     * Récupère tous les livres diponibles
     * @param string $status
     * @return Book[]
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
     * Supprime un livre par son id
     * @param int $id_book
     * @return void
     */
    public function deleteBook(int $id_book): void{
        $query = "DELETE FROM books WHERE id = ?";
        $this->pdo->query( $query, [$id_book] );
    }
    /**
     * Modification d'un livre
     * @param $book
     * @return void
     */
    public function updateBook(Book $book): void {
        $query = "UPDATE books SET title = :title, author = :author, description = :description, status = :status, image = :image, idUser = :idUser ";
        $this->pdo->query($query, ["title" => $book->getTitle(),"author" => $book->getAuthor(),"decription" => $book->getDescription(),"status" => $book->getStatus(),"image" => $book->getImage(),"idUser" => $book->getIdUser()]);
    }
    /**
     * Ajoute un livre dans la bdd
     * @param $book
     * @return void
     */
    public function addBook(Book $book): void{
        $query = "INSERT INTO books (title,author,description,status,image,idUser) VALUES (:title,:author,:description,:status,:image,:idUser)";
        $this->pdo->query( $query, ["title" => $book->getTitle(),"author" => $book->getAuthor(),"description" => $book->getDescription(),"status" => $book->getStatus(),"image" => $book->getImage(),"idUser" => $book->getIdUser()] );
    }
}