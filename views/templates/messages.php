<?php

?>

<div class="contactMenu">
    <?php foreach($contacts as $contact){ ?>
        <article class="contactList">
            <h2><?=  $contact["pseudo"] ?></h2>
            <p><?= $contact["content"] ?></p>
        </article>
    <?php } ?>
    <?php foreach($messages as $message){?>
        <article class="conversation">
            <h3><?= $message ?></h3>
        </article>
    <?php } ?>
    <form action="" method="post" class="">
        <input type="text" name="content">
        <input type="hidden" name="action" value="addMessage">
        <input type="hidden" name="idReceiver" value="<?= $lastMessageReceiverId ?>">
        <button class="submit">Envoyer</button>
    </form>
</div>