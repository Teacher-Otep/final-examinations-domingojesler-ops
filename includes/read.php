<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll();
?>