<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $type = $_POST['type'] ?? '';
    $feedback = $_POST['feedback'] ?? '';

    $servername ="localhost";
    $username ="root";
    $password ="";
    $dbname ="harmony_hub";

    $conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}   

$stmt = $conn->prepare("INSERT INTO feedback (name,email,type,message) VALUES(?,?,?,?)");
if (!$stmt){
    die("Error preparing statement: ".$conn->error);
}

$stmt->bind_param("ssss",$name,$email,$type,$feedback);
if($stmt->execute()){
    $to = "harmonyhubpeace@gmail.com";
    $subject = "New Feedback Received";
    $message = "Name: $name\nEmail: $email\nType: $type\nFeedback: $feedback";
    $headers = "From: $email"; 

    if(mail($to,$subject,$message,$headers));
    echo 'Email sent successfully';
}else{
    echo 'Email sending failed';
}

    header("Location: feedback.html?status=success");
    exit();
}else{
    echo "Error: ".$stmt->error;
}

$stmt->close();
$conn->close();

?>