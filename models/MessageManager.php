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
        $query = "SELECT content, dateSend, idUser, idReceiver FROM messages WHERE idUser = ? OR idReceiver = ? ORDER BY dateSend ASC";
        $stmt = $this->pdo->query( $query, [$userId, $userId] );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Retourne un tableau de tous les utilisateurs avec qui l'utilisateur a échangé
     * @param int $userId
     * @return array
     */
    public function getDistinctIdReceiver(int $userId): array{
        $query = "SELECT DISTINCT idReceiver FROM messages WHERE idUser = ?";
        $stmt = $this->pdo->query( $query, [$userId] );
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    /**
     * Retourne les messages échangés entre deux utilisateurs
     * @param int $userId
     * @param int $receiverId
     * @return array
     */
    public function getMessagesBetweenTwoUsers(int $userId, int $receiverId): array{
        $query = "SELECT content, dateSend, idUser, idReceiver FROM messages WHERE (idUser = ? AND idReceiver = ?) OR (idUser = ? AND idReceiver = ?) ORDER BY dateSend ASC";
        $stmt = $this->pdo->query( $query, [$userId, $receiverId, $receiverId, $userId] );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Retourne le dernier message reçu
     * @param int $userId
     * @return Message
     */
    public function getLastMessageReceive(int $userId) : ?Message{
        $query = "SELECT * FROM messages WHERE idReceiver = ? ORDER BY dateSend DESC LIMIT 1";
        $result = $this->pdo->query($query,[$userId]);
        return new Message($result->fetch(PDO::FETCH_ASSOC));
    }
    /**
     * Retourne le dernier message reçu d'un utilisateur
     * @param int $userId
     * @param int $receiverId
     * @return Message
     */
    public function getLastMessage(int $userId, int $receiverId) : ?Message{
        $query = "SELECT * FROM messages WHERE idUser = ? AND idReceiver = ? ORDER BY dateSend DESC LIMIT 1";
        $result = $this->pdo->query($query,[$userId, $receiverId]);
        return new Message($result->fetch(PDO::FETCH_ASSOC));
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
        $query = "INSERT INTO messages (idUser,idReceiver,content,dateSend) VALUES (:idUser,:idReceiver,:content,NOW())";
        $this->pdo->query( $query, ["idUser" => $message->getId_user(),"idReceiver" => $message->getIdReceiver(),"content" => $message->getContent()] );
    }
}