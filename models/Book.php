<?php

class Book extends AbstractEntity{
    private int $id_book;
    private string $title;
    private string $description;
    private string $author;
    private string $image;
    private bool $status;
    private int $idUser;
    public function getId(): int{
        return $this->id_book;
    }
    public function setId($id_book): void{
        $this->id_book = $id_book;
    }
    public function getTitle(): string{
        return $this->title;
    }
    public function setTitle($title): void{
        $this->title = $title;
    }
    public function getDescription(): string{
        return $this->description;
    }
    public function setDescription($description): void{
        $this->description = $description;
    }
    public function getImage(): string{
        return $this->image;
    }
    public function setImage($image): void{
        $this->image = $image;
    }
    public function getAuthor(): string{
        return $this->author;
    }
    public function setAuthor($author): void{
        $this->author = $author;
    }
    public function getStatus(): bool{
        return $this->status;
    }
    public function setStatus($status): void{
        $this->status = $status;
    }
    public function getIdUser(): int{
        return $this->idUser;
    }
    public function setIdUser($idUser): void{
        $this->idUser = $idUser;
    }
}