<?php
$conn =new mysqli("localhost","root","Abigael@2006","harmony_hub");
if ($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

$sql ="SELECT * FROM messages";
$result =$conn->query($sql);

if($result->num_rows >0){
    $messages = array();while($row =$result->fetch_assoc()){
        $messages[]=$row;
    }
    echo json_encode($messages);
}else{
    echo "0 results";
}

$conn->close();
?>