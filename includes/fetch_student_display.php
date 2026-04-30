<?php
require_once 'db.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
    $stmt->execute([$id]);
    $student = $stmt->fetch();

    if(!$student){
        echo "not_found";
        exit;
    }
}
?>

<div class="student-preview">
    <h3>Student Information</h3>

    <div class="info-box"><strong>ID:</strong> <?= $student['id'] ?></div>
    <div class="info-box"><strong>Surname:</strong> <?= $student['surname'] ?></div>
    <div class="info-box"><strong>Name:</strong> <?= $student['name'] ?></div>
    <div class="info-box"><strong>Middle Name:</strong> <?= $student['middlename'] ?></div>
    <div class="info-box"><strong>Address:</strong> <?= $student['address'] ?></div>
    <div class="info-box"><strong>Contact:</strong> <?= $student['contact_number'] ?></div>

</div>
</div>