<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contactmessage = $_POST['message'] ?? '';

    $servername ="localhost";
    $username ="root";
    $password ="";
    $dbname ="harmony_hub";

    $conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}   

$stmt = $conn->prepare("INSERT INTO feedback (name,email,message) VALUES(?,?,?)");
if (!$stmt){
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("sss",$name,$email,$message);
if($stmt->execute()) {
    $to = "harmonyhubpeace@gmail.com";
    $subject = "New Message Received";
    $emailMessage = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email"; 

    if(mail($to,$subject,$emailMessage,$headers));{
        echo 'Email sent successfully';
    } 

    header("Location: contact.html?status=success");
    exit();
}else{
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
}
?>