<?php

class MessageController{
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=connectionForm.php");
        }
        exit();
    }
    /**
     * Affiche la vue messages.php avec les contacts et derniers messages
     * @return void
     */
    public function showMessages():void
    {
        $this->checkIfUserIsConnected();
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($_POST['email']);
        $userId = $user->getId();

        $messageManager = new MessageManager();
        $receiverIds = $messageManager->getDistinctIdReceiver($userId);
        $contacts = [];
        foreach($receiverIds as $receiverId){
            $contacts[] = ["pseudo" => $userManager->getUserById($receiverId)->getPseudo(),"content" => $messageManager->getLastMessage($userId,$receiverId)];
        }
        $lastMessageReceiverId = $messageManager->getLastMessageReceive($userId)->getId_receiver();
        $messages = $messageManager->getMessagesBetweenTwoUsers($userId, $lastMessageReceiverId);

        $view = new View("Messagerie");
        $view->render("messages",['contacts' => $contacts,'messages' => $messages,'id' => $lastMessageReceiverId]);
    }
}