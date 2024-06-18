<?php
session_start();
if(isset($_SESSION['settings'])) {
    $notifications = $_SESSION['settings']['notifications'];
    $privacy = $_SESSION['settings']['privacy'];
} else{
    header("Location: settings.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Saved</title>
    <link rel="stylesheet" href="settings.css">
</head>
<body>
    <div class="container">
        <div class="header">
        </div>
        <p>Your settings have been saved successfully!</p>
        <p><strong>Notifications:</strong> <?php echo htmlspecialchars($notifications); ?></p>
        <p><strong>Privacy:</strong> <?php echo htmlspecialchars($privacy); ?></p>
        <a href="dashboard.html">Go back to dashboard</a>
    </div>
</body>
</html>
