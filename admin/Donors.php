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

// Read operation - Fetch all donors
$sqlRead = "SELECT * FROM donateur";
$stmtRead = $con->prepare($sqlRead);
$stmtRead->execute();
$donors = $stmtRead->fetchAll(PDO::FETCH_ASSOC);

// Update operation - Fetch donor details for editing
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit'])) {
    $editDonorId = $_GET['edit'];

    $sqlEdit = "SELECT * FROM donateur WHERE id = :donor_id";
    $stmtEdit = $con->prepare($sqlEdit);
    $stmtEdit->bindParam(':donor_id', $editDonorId, PDO::PARAM_INT);
    $stmtEdit->execute();
    $editDonor = $stmtEdit->fetch(PDO::FETCH_ASSOC);
}

// Update operation - Handle form submission for updating donor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $updateDonorId = $_POST['donor_id'];
    $updateLastName = $_POST['last_name'];
    $updateFirstName = $_POST['first_name'];
    $updateEmail = $_POST['email'];
    $varpassword=$_POST['Password'];
    $vardatenais=$_POST['Date_de_naissance'];
    $varlieures=$_POST['Lieu_de_residence'];


  
    $sqlUpdate = "UPDATE donateur 
                  SET Nom = :last_name, 
                      Prenom = :first_name, 
                      Email = :email, 
                      Password = :password, 
                      Date_de_naissance = :datenais, 
                      Lieu_de_residence = :lieures 
                  WHERE id = :donor_id";
    $stmtUpdate = $con->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':donor_id', $updateDonorId, PDO::PARAM_INT);
    $stmtUpdate->bindParam(':last_name', $updateLastName, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':first_name', $updateFirstName, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':email', $updateEmail, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':password', $varpassword, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':datenais', $vardatenais, PDO::PARAM_STR);
    $stmtUpdate->bindParam(':lieures', $varlieures, PDO::PARAM_STR);
    $stmtUpdate->execute();

    header("Location: current-page.php");
    exit();
}

// Delete operation - Handle deletion of donor
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $deleteDonorId = $_GET['delete'];

    $sqlDelete = "DELETE FROM donateur WHERE id = :donor_id";
    $stmtDelete = $con->prepare($sqlDelete);
    $stmtDelete->bindParam(':donor_id', $deleteDonorId, PDO::PARAM_INT);
    $stmtDelete->execute();

    header("Location: current-page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donors</title>
    <style>
    body {
    font-family: Arial, sans-serif;
}

table {
    width: 80%;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #ddd;
}

h2 {
    color: #4CAF50;
    margin-bottom: 15px;
}
form
{
    display: flex;
    flex-direction: column;
    width: 50%;
    margin: auto;
    margin-top: 50px;
    margin-bottom: 50px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px; 
}

label {
    display: flex;
    width: 200px;
    text-align: right;
    margin-right: 10px;
    
}

input[type="text"], input[type="email"] {

    
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    position: center;
}

input[type="submit"] {
    position: center;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin-left: 175px;
    border: none;
    cursor: pointer;
    width: 50%;
    
}

input[type="submit"]:hover {
    background-color: #45a049;
    
}
</style>
</head>
<body>

<h2>Donors</h2>

<!-- Display donors -->
<table border="1">
    <tr>
        <th>Donor ID</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>CIN</th>
        <th>Date de naissance</th>
        <th>Lieu de residence</th>
        <th>Action</th>
    </tr>
    <?php foreach ($donors as $donor): ?>
        <tr>
            <td><?= $donor['id'] ?></td>
            <td><?= $donor['Nom'] ?></td>
            <td><?= $donor['Prenom'] ?></td>
            <td><?= $donor['Email'] ?></td>
            <td><?= $donor['Password'] ?></td>
            <td><?= $donor['CIN'] ?></td>
            <td><?= $donor['Date_de_naissance'] ?></td>
            <td><?= $donor['Lieu_de_residence'] ?></td>



            <td>
                <a href="?edit=<?= $donor['id'] ?>">Edit</a>
                <a href="?delete=<?= $donor['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Edit form -->
<?php if (isset($editDonor)): ?>
    <h2>Edit Donor</h2>

    <form method="post" action="Donors.php">
        <input type="hidden" name="donor_id" value="<?= $editDonor['id'] ?>">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?= $editDonor['Nom'] ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?= $editDonor['Prenom'] ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $editDonor['Email'] ?>">
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="<?= $editDonor['Password'] ?>">
        <label for="datenais">Date de naissance:</label>
        <input type="text" id="datenais" name="datenais" value="<?= $editDonor['Date_de_naissance'] ?>">
        <label for="lieures">Lieu de residence:</label>
        <input type="text" id="lieures" name="lieures" value="<?= $editDonor['Lieu_de_residence'] ?>">

        <input type="submit" name="update" value="Update">
        
    </form>
<?php endif; ?>

</body>
</html>
