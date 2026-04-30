<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $check_id = $pdo->prepare("SELECT id FROM students WHERE id = ?");
    $check_id->execute([$_POST['id']]);
    
    if ($check_id->rowCount() > 0) {
        header("Location: ../public/index.php?status=error_id&section=create");
        exit();
    }

    $check_name = $pdo->prepare("SELECT id FROM students WHERE surname = ? AND name = ?");
    $check_name->execute([$_POST['surname'], $_POST['name']]);
    
    if ($check_name->rowCount() > 0) {
        header("Location: ../public/index.php?status=error_name&section=create");
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO students 
        (id, surname, name, middlename, address, contact_number)
        VALUES (?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $_POST['id'],
        $_POST['surname'],
        $_POST['name'],
        $_POST['middlename'],
        $_POST['address'],
        $_POST['contact']
    ]);

    header("Location: ../public/index.php?status=success&section=create");
}
?>