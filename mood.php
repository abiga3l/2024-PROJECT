<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $mood = $_POST['mood'];
    $notes = $_POST['notes'];
    $date = $_POST['date'];

    $servername ="localhost";
    $username ="root";
    $password ="";
    $dbname ="harmony_hub";

    $conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

    $query ="INSERT INTO mood_tracker (user_id,mood,notes,date) VALUES(?,?,?,?)";
    $stmt =$conn->prepare($query);
    $stmt->bind_param("isss",$userId,$mood,$notes,$date);

    header("Location:moodtracker.html");
    exit();
} else {
    echo "Can't be logged in!";
}
?>