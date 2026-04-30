<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // CHECK DUPLICATE ID
    $check_id = $pdo->prepare("SELECT id FROM students WHERE id = ?");
    $check_id->execute([$_POST['id']]);
    
    if ($check_id->rowCount() > 0) {
        header("Location: ../public/index.php?status=error_id&section=create");
        exit();
    }

    // CHECK DUPLICATE NAME
    $check_name = $pdo->prepare("SELECT id FROM students WHERE surname = ? AND name = ?");
    $check_name->execute([$_POST['surname'], $_POST['name']]);
    
    if ($check_name->rowCount() > 0) {
        header("Location: ../public/index.php?status=error_name&section=create");
        exit();
    }

    // INSERT DATA
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

    // ✅ FIXED STATUS HERE
    header("Location: ../public/index.php?status=added&section=create");
}
?>
