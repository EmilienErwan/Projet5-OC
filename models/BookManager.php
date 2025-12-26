<?php 

class BookManager extends AbstractEntity{
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
        $query = "UPDATE books SET title = :title, author = :author, description = :description, status = :status ";
        $this->pdo->query($query, ["title" => $book->getTitle(),"author" => $book->getAuthor(),"decription" => $book->getDescription(),"status" => $book->getStatus()]);
    }
    /**
     * Ajoute un livre dans la bdd
     * @param $book
     * @return void
     */
    public function addBook(Book $book): void{
        $query = "INSERT INTO books (title,author,description,status) VALUES (:title,:author,:description,:status)";
        $this->pdo->query( $query, ["title" => $book->getTitle(),"author" => $book->getAuthor(),"description" => $book->getDescription(),"status" => $book->getStatus()] );
    }
}