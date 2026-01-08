<?php

class MessageController{
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['log'])) {
            header("Location: index.php?action=showConnectionForm");
        }
    }
    /**
     * Affiche la vue messages.php avec les contacts et derniers messages
     * @return void
     */
    public function showMessages():void
    {
        $this->checkIfUserIsConnected();
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($_SESSION['log']);
        $userId = $user->getId();

        $messageManager = new MessageManager();
        $receiverIds = $messageManager->getDistinctIdReceiver($userId);
        $contacts = [];
        foreach($receiverIds as $receiverId){
            $contacts[] = ["pseudo" => $userManager->getUserById($receiverId)->getPseudo(),"content" => $messageManager->getLastMessage($userId,$receiverId),"idReceiver" => $receiverId];
        }
        if(isset($_GET['id'])){
            $lastMessageReceiverId = $_GET['id'];
            if($messageManager->getMessagesBetweenTwoUsers($userId, $lastMessageReceiverId) == null){
                throw new Exception("Vous n'avez pas de messages avec cet utilisateur.");
            }
        }else{
            $lastMessageReceiverId = $messageManager->getLastMessageReceive($userId)->getIdUser();
        }
        $messages = $messageManager->getMessagesByUserId($userId);

        $view = new View("Messagerie");
        $view->render("messages",['contacts' => $contacts,'messages' => $messages,'id' => $lastMessageReceiverId]);
    }
}