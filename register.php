<?php
session_set_cookie_params(0,'/','',true,true);
session_start();

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['fullname'],$_POST['email'],$_POST['password'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $fullname=filter_var($fullname,FILTER_SANITIZE_STRING);
    $email=filter_var($email,FILTER_SANITIZE_EMAIL);

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }
    if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/',$password)) {
    echo "Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one number, and one special character.";
    exit();
}
    $sql_check_email= "SELECT id FROM users WHERE email = ?";

    if($stmt_check_email = $conn->prepare($sql_check_email)) {
        $stmt_check_email->bind_param("s",$email);
        $stmt_check_email->execute();
        $stmt_check_email->store_result();

    if($stmt_check_email->num_rows>0){
        echo "Email already exists.";
        exit();
    }

    $stmt_check_email->close();
}else{
    error_log("Error:Could not prepare.",3,'errors.log');
    echo "Error :Could not prepare.";
    exit();
}

$hashed_password =password_hash($password,PASSWORD_DEFAULT);
$sql_insert_user = "INSERT INTO users(fullname,email,password)VALUES(?,?,?)";

if($stmt_insert_user =$conn->prepare($sql_insert_user)) {
    $stmt_insert_user->bind_param("sss",$fullname,$email,$hashed_password);

if($stmt_insert_user->execute()) {
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $stmt_insert_user->insert_id;
    $_SESSION['name'] = $fullname;
    $_SESSION['email'] = $email;
    
    $stmt_insert_user->close();

    header('Location:dashboard.html');
    exit();
    }else{
        error_log("Error:Could not insert.",3,'errors.log');
        echo "Error:Could not execute.";
        exit();
        }
    }else{
        error_log("Error:Could not prepare statement.",3,'errors.log');
        echo "Error:Could not prepare statement.";
        exit();
        }
        $conn->close();
    }else{
        echo "Please fill out the fullname, email, and password fields.";
        exit();
    }
    }else{
        echo "Invalid request method.";
        exit();
    }