<?php

class Book extends AbstractEntity{
    private int $id_book;
    private string $title;
    private string $description;
    private string $author;
    private string $image;
    private bool $status;
    private int $id_user;
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
    public function getId_user(): int{
        return $this->id_user;
    }
    public function setId_user($id_user): void{
        $this->id_user = $id_user;
    }
}