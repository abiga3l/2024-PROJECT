<?php
include 'config.php';
 $sender_id = $_POST['sender_id'];
 $receiver_id = $_POST['receiver_id'];
 $message = $_POST['message'];

 $stmt = $pdo->prepare('INSERT INTO messages(sender_id,receiver_id,message) VALUES(?,?,?)');
    $stmt->execute([$sender_id,$receiver_id,$message]);

    echo 'Message sent';
    ?>