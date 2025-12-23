<?php 

class MessageManager extends AbstractEntity{
    /**
     * Retourne un message par son id
     * @param int $messageId
     * @return Message|null
     */
    public function getMessageById(int $messageId): ?Message{
        $query = "SELECT * FROM messages WHERE id = ?";
        $stmt = $this->pdo->query( $query,[$messageId]);
        $message = $stmt->fetch(PDO::FETCH_ASSOC);
        if( $message ){
            return new Message($message);
        }
        return null;
    }
    /**
     * Retourne un tableau de tous les messages reçus par un utilisateur
     * @param int $userId
     * @return Message[]
     */
    public function getMessagesByUserId(int $userId): array{
        $messages = [];
        $query = "SELECT id FROM messages WHERE id_user = ?";
        $stmt = $this->pdo->query( $query, [$userId] );
        while($message = $stmt->fetch(PDO::FETCH_ASSOC)){
            $messages[] = new Message($message);
        }
        return $messages;
    }
    /**
     * Retourne un tableau de tous les utilisateurs avec qui l'utilisateur a échangé
     * @param int $userId
     * @return array
     */
    public function getDistinctIdReceiver(int $userId): array{
        $idReceiver = [];
        $query = "SELECT DISTINCT id_receiver FROM messages WHERE id_user = ?";
        $stmt = $this->pdo->query( $query, [$userId] );
        while($receiver = $stmt->fetch(PDO::FETCH_ASSOC)){
            $idReceiver[] = $receiver;
        }
        return $idReceiver;
    }
    /**
     * Retourne les messages échangés entre deux utilisateurs
     * @param int $userId
     * @param int $receiverId
     * @return array
     */
    public function getMessagesBetweenTwoUsers(int $userId, int $receiverId): array{
        $messages = [];
        $query = "SELECT content FROM messages WHERE id_user = ? AND id_receiver = ?";
        $stmt = $this->pdo->query( $query, [$userId, $receiverId] );
        while($message = $stmt->fetch(PDO::FETCH_ASSOC)){
            $messages[] = $message;
        }
        return $messages;
    }
    /**
     * Supprime un message par son id
     * @param int $id_message
     * @return void
     */
    public function deleteMessage(int $id_message): void{
        $query = "DELETE FROM messages WHERE id = ?";
        $this->pdo->query( $query, [$id_message] );
    }
    /**
     * Modifie le contenu d'un message par son id
     * @param int $id_message
     * @param string $content
     * @return void
     */
    public function updateMessage(int $id_message, string $content): void{
        $query = "UPDATE messages SET content = ? WHERE id = ?";
        $this->pdo->query( $query, [$id_message, $content] );
    }
    /**
     * Ajoute un message dans la bdd
     * @param $message
     * @return void
     */
    public function addMessage(Message $message): void{
        $query = "INSERT INTO messages (id_user,id_receiver,content) VALUES (:id_user,:id_receiver,:content)";
        $this->pdo->query( $query, ["id_user" => $message->getId_user(),"id_receiver" => $message->getId_receiver(),"content" => $message->getContent()] );
    }
}