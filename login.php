<?php
session_start();

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fullname'], $_POST['email'], $_POST['password'])) {
        $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $sql_check_email = "SELECT id, password FROM users WHERE email = ?";

        if ($stmt_check_email = $conn->prepare($sql_check_email)) {
            $stmt_check_email->bind_param("s", $email);
            $stmt_check_email->execute();
            $result = $stmt_check_email->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashed_password = $row['password'];

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['name'] = $fullname;
                    $_SESSION['email'] = $email;
                    header('Location: dashboard.html');
                    exit();
                } else {
                    echo "Invalid email or password.";
                }
            } else {
                echo "Invalid email or password.";
            }

            $stmt_check_email->close();
        } else {
            echo "Error preparing the statement.";
        }
    } else {
        echo "Please fill in all the required fields.";
    }
} else {
    echo "Invalid request method.";
}
?>