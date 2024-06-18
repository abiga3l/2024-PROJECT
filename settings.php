<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $notifications = $_POST['notifications'];
    $privacy = $_POST['privacy'];

    $valid_notifications = ['all', 'email', 'none'];
    $valid_privacy = ['public', 'friends', 'private'];

    if(in_array($notifications,$valid_notifications) && in_array($privacy, $valid_privacy)) {
        session_start();
        $_SESSION['settings'] = [
            'notifications' => $notifications,
            'privacy' => $privacy
        ];
        header("Location:settings_save.php");
        exit();
    } else {
        echo "Invalid settings!";
    }
}
?>
