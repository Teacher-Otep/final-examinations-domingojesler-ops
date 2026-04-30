<?php
require_once 'db.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $stmt=$pdo->prepare("SELECT * FROM students WHERE id=?");
    $stmt->execute([$id]);
    $u=$stmt->fetch();

    if($u){
?>
<form method="POST" action="../includes/update.php" id="updateForm" onsubmit="return confirmUpdate()">
    <input type="hidden" name="id" value="<?= $u['id'] ?>">

    <label>Surname</label>
    <input name="surname" value="<?= $u['surname'] ?>" class="field"><br>

    <label>Name</label>
    <input name="name" value="<?= $u['name'] ?>" class="field"><br>

    <label>Middle Name</label>
    <input name="middlename" value="<?= $u['middlename'] ?>" class="field"><br>

    <label>Address</label>
    <input name="address" value="<?= $u['address'] ?>" class="field"><br>

    <label>Contact</label>
    <input name="contact" value="<?= $u['contact_number'] ?>" class="field"><br>

    <div class="btn-group">
        <button type="button" class="btn-clear" onclick="clearUpdateFields()">Clear</button>
        <button type="submit" class="btn-update">Update Record</button>
    </div>
</form>

<script>
function confirmUpdate(){
    return confirm("✅ Are you sure you want to UPDATE this student record?");
}
function clearUpdateFields(){
    document.querySelectorAll('#updateForm input').forEach(i=>i.value='');
}
</script>
<?php
    } else {
        echo 'not_found';
    }
}
?>