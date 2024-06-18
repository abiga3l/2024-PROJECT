<?php
session_start();
include 'config.php';

$userId = $_SESSION['user_id'];

$moodCounts = [
    "Happy" => 0,
    "Sad" => 0,
    "Anxious" => 0,
    "Neutral" => 0,
    "Not sure" => 0
];

$query ="SELECT mood,COUNT(*) as count FROM mood_tracker WHERE user_id = ? GROUP BY mood";
$stmt = $conn->prepare($query);
$stmt->bind_param("i",$userId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $moodCounts[$row['mood']] = $row['count'];
}
echo json_encode(array_values($moodCounts));
?>