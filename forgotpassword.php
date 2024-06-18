<?php
session_start();
require_once 'config.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email =$_POST['email'];
    
    $sql = "SELECT id,email FROM users WHERE email = ?";

    if($stmt =$conn->prepare($sql)){
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
            echo "We have sent password reset instructions to your email.";
        };
    }else{
    echo "Error: Could not prepare SQL statement.";
    }
    $stmt->close();
}
$conn->close();
?>