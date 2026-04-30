<!DOCTYPE html>
<html>
<head>
    <title>Student System</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<nav class="navbar">
    <img src="../images/logo.png" id="logo" alt="Logo">
    <div class="navbar-buttons">
        <button class="navbarbuttons" onclick="showSection('create')">Create</button>
        <button class="navbarbuttons" onclick="showSection('read')">Read</button>
        <button class="navbarbuttons" onclick="showSection('update')">Update</button>
        <button class="navbarbuttons" onclick="showSection('delete')">Delete</button>
    </div>
</nav>
<section class="homecontent">
    <h1>WELCOME STUDENT SYSTEM</h1>
</section>
<section id="create" class="content">
<h2>Create Student</h2>
<form action="../includes/insert.php" method="POST" id="createForm">
    <label>ID Number</label>
    <input type="text" name="id" class="field" placeholder="Enter ID Number" required><br>

    <label>Surname</label>
    <input name="surname" class="field" placeholder="Surname" required><br>

    <label>Name</label>
    <input name="name" class="field" placeholder="Name" required><br>

    <label>Middle Name</label>
    <input name="middlename" class="field" placeholder="Middle Name"><br>

    <label>Address</label>
    <input name="address" class="field" placeholder="Address" required><br>

    <label>Contact</label>
    <input name="contact" class="field" placeholder="Contact" required><br>

    <div class="btn-group">
        <button type="button" class="btn-clear" onclick="clearFields()">Clear</button>
        <button type="submit" class="btn-save">Save</button>
    </div>
</form>
</section>

<section id="read" class="content">
<h2>View Students</h2>
<?php include '../includes/read.php'; ?>
<table>
<tr><th>ID</th><th>Surname</th><th>Name</th><th>Address</th><th>Contact</th></tr>
<?php foreach($students as $s): ?>
<tr>
<td><?= $s['id'] ?></td>
<td><?= $s['surname'] ?></td>
<td><?= $s['name'] ?></td>
<td><?= $s['address'] ?></td>
<td><?= $s['contact_number'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</section>

<section id="update" class="content">
<h2>Update Student</h2>

<div class="search-container">
    <input type="text" id="search_id" class="search-field" placeholder="Enter Student ID to load">
    <button type="button" class="btn-load" id="load_data_btn">Load Data</button>
</div>

<div id="update_form_area"></div>

</section>

<section id="delete" class="content">
<h2>Delete Student</h2>

<div class="search-container">
    <input type="text" id="delete_id_input" class="search-field" placeholder="Enter Student ID">
    <button type="button" class="btn-delete" id="delete_btn">Delete Student</button>
</div>

</section>

<script src="script.js"></script>
</body>
</html>
