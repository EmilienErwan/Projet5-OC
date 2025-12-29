<?php

class User extends AbstractEntity{
    private int $id_user;
    private string $name;
    private string $pseudo;
    private string $password;
    private string $library;
    private DateTime $inscriptionDate;
    private string $profilImage;
    private string $email;
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
    public function getInscriptionDate(): DateTime{
        return $this->inscriptionDate;
    }
    public function setInscriptionDate(DateTime $inscriptionDate): void{
        $this->inscriptionDate = $inscriptionDate;
    }
    public function getProfilImage(): string{
        return $this->profilImage;
    }
    public function setProfilImage(string $profilImage): void{
        $this->profilImage = $profilImage;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function setEmail(string $email): void{
        $this->email = $email;
    }
}