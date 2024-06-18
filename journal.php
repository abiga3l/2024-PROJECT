<?php
include 'config.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $entry =$_POST['entry'];
    $user_id = 1;

    if(!empty($entry)) {
        $stmt = $conn->prepare("INSERT INTO journal_entries(user_id,entry)VALUES(?,?");
        $stmt->bind_param("is",$user_id,$entry);

    if($stmt->execute()) {
        echo "Entry saved successfully!";
    }else{
        echo "Error: ".$stmt->error;
    }
    $stmt->close();
    }else{
        echo "Please write something.";
    }
}
?>

