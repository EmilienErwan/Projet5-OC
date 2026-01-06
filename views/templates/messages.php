<?php
$contacts = $params['contacts'];
$messages = $params['messages'];
if(isset($_GET['id'])){
    $lastMessageReceiverId = $_GET['id'];
}else{
    $lastMessageReceiverId = $params['id'];
}
$userManager = new UserManager();
?>

<div class="contactMenu">
    <?php if($contacts === null){ 
        echo "Vous n'avez pas de messages";
     }else{ ?>
     <h1>Messagerie</h1>
        <?php foreach($contacts as $contact){ ?>
            <article class="contactList">
                <h2><a href="index.php?action=showMessages&id=<?= $contact["idReceiver"] ?>"><?= $contact["pseudo"] ?></a></h2>
                <p><?= $contact["content"]->getContent() ?></p>
            </article>
        <?php } ?>
        <h2><?= $userManager->getUserById($lastMessageReceiverId)->getPseudo() ?></h2>
        <?php foreach($messages as $message){?>
            <article class="conversation">
                <?php if((int)$message["idUser"] === (int)$lastMessageReceiverId || (int)$message["idReceiver"] === (int)$lastMessageReceiverId){ ?>
                <h3><?= $message["content"] ?></h3>
                <?php } ?>
            </article>
        <?php } ?>
        <form action="" method="post" class="">
            <input type="text" name="content">
            <input type="hidden" name="idReceiver" value="<?= $lastMessageReceiverId ?>">
            <button class="submit">Envoyer</button>
        </form>
    <?php } ?>
</div>