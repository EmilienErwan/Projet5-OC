<?php

class User extends AbstractEntity{
    private int $id_user;
    private string $name;
    private string $pseudo;
    private string $password;
    private string $library;

    public function getId(): int{
        return $this->id_user;
    }
    public function setId(int $id_user): void{
        $this->id_user = $id_user;
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