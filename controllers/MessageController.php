<?php

class MessageController{
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['email'])) {
            header("Location: index.php?action=showConnectionForm");
        }
    }
    /**
     * Affiche la vue messages.php avec les contacts et derniers messages
     * @return void
     */
    public function showMessages():void {
        $this->checkIfUserIsConnected();
        $userManager = new UserManager();
        $userId = $_SESSION['id'];

        $messageManager = new MessageManager();
        $receiverIds = $messageManager->getDistinctIdReceiver($userId);
        $contacts = [];

        foreach($receiverIds as $receiverId){
            $contacts[] = ["pseudo" => $userManager->getUserById($receiverId)->getPseudo(),
                        "content" => $messageManager->getLastMessage($userId,$receiverId),
                        "idReceiver" => $receiverId,
                        "profilImage" => $userManager->getUserById($receiverId)->getProfilImage()];
        }

        $infoMessage = null;
        $messages = [];
        $lastMessageReceiverId = null;
        if(empty($receiverIds)){
            $infoMessage = "Vous n'avez pas encore de messages. Envoyez-en à un utilisateur pour commencer une conversation !";
        }else{
            if(isset($_GET['id'])){
                $lastMessageReceiverId = $_GET['id'];
            }elseif(isset($_GET["idUser"]) && $_GET["idUser"] != ""){
                $lastMessageReceiverId = $_GET["idUser"];
            }else{
                $lastMessageReceiverId = $messageManager->getLastMessageReceive($userId)->getIdUser();
            }
            $messages = $messageManager->getMessagesByUserId($userId);
        }
        $view = new View("Messagerie");
        $view->render("messages",['contacts' => $contacts,'messages' => $messages,'id' => $lastMessageReceiverId,'infoMessage' => $infoMessage]);
    }
    public function sendMessage():void {
        $userId = $_SESSION['id'];
        $messageManager = new MessageManager();
        $message = new Message();

        if(isset($_POST['content']) && $_POST['content'] !== ""){
            $message->setContent($_POST['content']);
            $message->setIdReceiver($_POST['idReceiver']);
            $message->setIdUser($userId);
            $messageManager->addMessage($message);
        }
        header("Location: index.php?action=showMessages&id=".$_POST['idReceiver']);
    }
}