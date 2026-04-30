<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("UPDATE students SET 
        surname=?, name=?, middlename=?, address=?, contact_number=? 
        WHERE id=?");
    
    $stmt->execute([
        $_POST['surname'],
        $_POST['name'],
        $_POST['middlename'],
        $_POST['address'],
        $_POST['contact'],
        $_POST['id']
    ]);

    header("Location: ../public/index.php?status=updated&section=update");
}
?>
