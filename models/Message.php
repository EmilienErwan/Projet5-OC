<?php

class Message extends AbstractEntity{
    private int $id_message;
    private int $id_user;
    private int $id_receiver;
    private string $content;
    public function getId(): int{
        return $this->id_message;
    }
    public function setId(int $id_message): void{
        $this->id_message = $id_message;
    }
    public function getId_user(): int{
        return $this->id_user;
    }
    public function setId_user(int $id_user): void{
        $this->id_user = $id_user;
    }
    public function getId_receiver(): int{
        return $this->id_receiver;
    }
    public function setId_receiver(int $id_receiver): void{
        $this->id_receiver = $id_receiver;
    }
    public function getContent(): string{
        return $this->content;
    }
    public function setContent(string $content): void{
        $this->content = $content;
    }
}