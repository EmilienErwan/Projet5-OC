<?php
$contacts = $params['contacts'];
$messages = $params['messages'];
$infoMessage = $params['infoMessage'];
$lastMessageReceiverId = $params['id'];
$userManager = new UserManager();
?>
<?php if(isset($infoMessage)) { ?>
    <p class="infoMessage"><?= $infoMessage ?></p>
<?php }else { ?>
<div class="messagesLayout">
    <h1>Messagerie</h1>
    <div class="contactMenu">
        <?php if($contacts === null){ 
            echo "Vous n'avez pas de messages";
        }else{ ?>
            <article class="contactList">
                <?php foreach($contacts as $contact){ ?>
                <?php if($contact["content"]->getMessageRead() == 0){
                            $contents = "newMessage";
                        }else{
                            $contents = "content";
                        } ?>
                <div class ="contactItem">
                    <a href="index.php?action=showMessages&id=<?= $contact["idReceiver"] ?>">
                        <div class="contactInfo">
                            <img src=<?= $contact["profilImage"] ?> alt="<?= $contact["pseudo"] ?>">
                            <h2><?= $contact["pseudo"] ?></h2>
                        </div>
                        <p class=<?= $contents ?>><?= mb_strlen($contact["content"]->getContent()) > 30 ? mb_substr($contact["content"]->getContent(), 0, 30) . "..." : $contact["content"]->getContent() ?></p>
                    </a>
                </div>
                <?php } ?>
            </article>
            <article class="conversation">
                <div class="contactInfo">
                    <img src="<?= $userManager->getUserById($lastMessageReceiverId)->getProfilImage() ?>" alt="<?= $userManager->getUserById($lastMessageReceiverId)->getPseudo() ?>">
                    <h2><?= $userManager->getUserById($lastMessageReceiverId)->getPseudo() ?></h2>
                </div>
                <?php foreach($messages as $message){?>
                        <?php if((int)$message["idUser"] === (int)$lastMessageReceiverId || (int)$message["idReceiver"] === (int)$lastMessageReceiverId){ ?>
                            <?php if((int)$message["idUser"] === (int)$lastMessageReceiverId){ ?>
                                <div class = "message received">
                                    <p class="receivedMessage"><?= $message["content"] ?></p>
                                </div>
                            <?php }else{ ?>
                                <div class = "message sent">
                                    <p class="sentMessage"><?= $message["content"] ?></p>
                                    </div>
                            <?php } ?>
                        <?php } ?>
                <?php } ?>
                <form action="index.php?action=sendMessage" method="post" class="sendMessageForm">
                    <input type="text" name="content" class="messageBar" placeholder="Tapez votre message ici" required>
                    <input type="hidden" name="idReceiver" value="<?= $lastMessageReceiverId ?>">
                    <button class="submit">Envoyer</button>
                </form>
            </article>
        <?php } ?>
    </div>
</div>
<?php } ?>