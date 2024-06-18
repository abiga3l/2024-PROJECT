<?php
include 'config.php';

$stmt = $pdo->query('SELECT id,username FROM users');
$users = $stmt->fetchAll();

echo json_encode($users);
?>