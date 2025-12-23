<?php

class User{
    private int $id;
    private string $name;
    private string $pseudo;
    private string $password;
    private string $library;

    public function getId(): int{
        return $this->id;
    }
    public function setId(int $id): void{
        $this->id = $id;
    }
    public function getName(): string{
        return $this->name;
    }
    public function setName(string $name): void{
        $this->name = $name;
    }
    public function getPseudo(): string{
        return $this->pseudo;
    }
    public function setPseudo(string $pseudo): void{
        $this->pseudo = $pseudo;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function setPassword(string $password): void{
        $this->password = $password;
    }
    public function getLibrary(): string{
        return $this->library;
    }
    public function setLibrary(string $library): void{
        $this->library = $library;
    }
}