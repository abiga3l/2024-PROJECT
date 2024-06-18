<?php
include 'config.php';

$user_id = 1;
$stmt = $conn->prepare("SELECT entry, created_at FROM journal_entries WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$entries = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Journal Entries</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #e8f5ea;
            margin: 0;
            padding: 20px;
        }
        #entries {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .entry {
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #b2dfbd;
        }
        .entry:last-child {
            border-bottom: none;
        }
        .date {
            font-size: 12px;
            color: #666;
        }
        .text {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div id="entries">
        <h1>Your Journal Entries</h1>
        <?php foreach ($entries as $entry): ?>
            <div class="entry">
                <div class="date"><?php echo htmlspecialchars($entry['created_at']); ?></div>
                <div class="text"><?php echo nl2br(htmlspecialchars($entry['entry'])); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>