<?php

class Message extends AbstractEntity{
    private int $idMessage;
    private int $idUser;
    private int $idReceiver;
    private string $content;
    private bool $messageRead = false;
    private DateTime $dateSend;
    public function getId(): int{
        return $this->idMessage;
    }
    public function setId(int $idMessage): void{
        $this->idMessage = $idMessage;
    }
    public function getIdUser(): int{
        return $this->idUser;
    }
    public function setIdUser(int $idUser): void{
        $this->idUser = $idUser;
    }
    public function getIdReceiver(): int{
        return $this->idReceiver;
    }
    public function setIdReceiver(int $idReceiver): void{
        $this->idReceiver = $idReceiver;
    }
    public function getContent(): string{
        return $this->content;
    }
    public function setContent(string $content): void{
        $this->content = $content;
    }
    public function getDate(): DateTime{
        return $this->dateSend;
    }
    public function setDate(string $date): void{
        $this->dateSend = new DateTime($date);
    }
    public function getMessageRead(): bool{
        return $this->messageRead;
    }
    public function setMessageRead(bool $messageRead): void{
        $this->messageRead = $messageRead;
    }
}