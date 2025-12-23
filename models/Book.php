<?php

class Book{
    private int $id;
    private string $title;
    private string $description;
    private string $author;
    private string $image;
    private bool $status;
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function setAuthor($author){
        $this->author = $author;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status = $status;
    }
}