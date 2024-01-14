<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

include("header.php");

try {
    $con = new PDO("mysql:host=localhost; dbname=association_dons", 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
}

// Function to handle adding a new contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $addFirstName = $_POST['first_name'];
    $addLastName = $_POST['last_name'];
    $addEmail = $_POST['email'];
    $addMobile = $_POST['mobile'];
    $addMessage = $_POST['message'];
    $addDateContact = $_POST['date_contact'];

    $sqlAdd = "INSERT INTO contact (First_name, Last_name, email, mobile, message, date_contact) 
               VALUES (:first_name, :last_name, :email, :mobile, :message, :date_contact)";
    $stmtAdd = $con->prepare($sqlAdd);
    $stmtAdd->bindParam(':first_name', $addFirstName, PDO::PARAM_STR);
    $stmtAdd->bindParam(':last_name', $addLastName, PDO::PARAM_STR);
    $stmtAdd->bindParam(':email', $addEmail, PDO::PARAM_STR);
    $stmtAdd->bindParam(':mobile', $addMobile, PDO::PARAM_INT);
    $stmtAdd->bindParam(':message', $addMessage, PDO::PARAM_STR);
    $stmtAdd->bindParam(':date_contact', $addDateContact, PDO::PARAM_STR);
    $stmtAdd->execute();
}

// Function to handle updating an existing contact


// Function to handle deleting a contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $deleteContactId = $_POST['contact_id'];

    $sqlDelete = "DELETE FROM contact WHERE id = :contact_id";
    $stmtDelete = $con->prepare($sqlDelete);
    $stmtDelete->bindParam(':contact_id', $deleteContactId, PDO::PARAM_INT);
    $stmtDelete->execute();
}

// Fetch all contacts initially
$sqlSelect = "SELECT * FROM contact";
$stmtSelect = $con->prepare($sqlSelect);
$stmtSelect->execute();
$contacts = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h2 {
    background-color: #f0f0f0;
    margin: 0;
    padding: 20px;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    max-width: 600px;
    margin: 20px auto;
}

label {
    margin-bottom: 10px;
}

input, textarea {
    margin-bottom: 20px;
    padding: 10px;
}

button {
    background-color: #007BFF;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 18px;
    margin-top: 10px;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-family: 'Arial', sans-serif;
    transition-duration: 0.4s;
}

button:hover {
    background-color: #0056b3;
    color: white;
}

table {
    border-collapse: collapse;
    margin: 20px auto;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f0f0f0;
}
        </style>
</head>
<body>

<h2>Contact Management</h2>

<!-- Add Form -->

<!-- Display contacts -->
<table border="1">
    <tr>
        <th>Contact ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Message</th>
        <th>Date of Contact</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?= $contact['id'] ?></td>
            <td><?= $contact['First_name'] ?></td>
            <td><?= $contact['Last_name'] ?></td>
            <td><?= $contact['email'] ?></td>
            <td><?= $contact['mobile'] ?></td>
            <td><?= $contact['message'] ?></td>
            <td><?= $contact['date_contact'] ?></td>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="contact_id" value="<?= $contact['id'] ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
