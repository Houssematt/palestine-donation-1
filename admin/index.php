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


// Fetch all donations initially
$sql = "SELECT d.Don_id, d.Donor_id, d.Donation_date, d.Donation_type,
               dn.Nom AS donor_nom, dn.Prenom AS donor_prenom, dn.Email AS donor_email,
               sd.blood_type, sd.date_visite_medicale,
               dc.taille, dc.descr, dc.zip_code,
               da.montant, da.methode_payment, da.tran_id
        FROM donation d
        LEFT JOIN sang_donation sd ON d.Don_id = sd.Don_id
        LEFT JOIN don_cloth dc ON d.Don_id = dc.Don_id
        LEFT JOIN don_argent da ON d.Don_id = da.Don_id
        LEFT JOIN donateur dn ON d.Donor_id = dn.id
        ORDER BY d.Donation_date ASC";

$stmt = $con->prepare($sql);
$stmt->execute();
$donations = $stmt->fetchAll(PDO::FETCH_ASSOC);
$filterType = null;
// Handle filtering if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $filterStartDate = $_POST['filter_start_date'] ?? null;
    $filterEndDate = $_POST['filter_end_date'] ?? null;
    $filterType = $_POST['filter_type'] ?? null;

    // Build the query based on the filters
    $sql = "SELECT d.Don_id, d.Donor_id, d.Donation_date, d.Donation_type,
                   dn.Nom AS donor_nom, dn.Prenom AS donor_prenom, dn.Email AS donor_email";
                   

    if ($filterType === 'blood') {
        $sql .= ", sd.blood_type, sd.date_visite_medicale";
    } elseif ($filterType === 'Clothes') {
        $sql .= ", dc.taille, dc.descr, dc.zip_code";
    } elseif ($filterType === 'money') {
        $sql .= ", da.montant, da.methode_payment, da.tran_id";
    }

    $sql .= " FROM donation d
              LEFT JOIN sang_donation sd ON d.Don_id = sd.Don_id
              LEFT JOIN don_cloth dc ON d.Don_id = dc.Don_id
              LEFT JOIN don_argent da ON d.Don_id = da.Don_id
              LEFT JOIN donateur dn ON d.Donor_id = dn.id
              WHERE 1";

    if ($filterStartDate) {
        $sql .= " AND d.Donation_date >= :filter_start_date";
    }

    if ($filterEndDate) {
        $sql .= " AND d.Donation_date <= :filter_end_date";
    }

    if ($filterType) {
        $sql .= " AND d.Donation_type = :filter_type";
    }

    $sql .= " ORDER BY d.Donation_date ASC";

    // Execute the filtered query
    $stmt = $con->prepare($sql);

    if ($filterStartDate) {
        $stmt->bindParam(':filter_start_date', $filterStartDate, PDO::PARAM_STR);
    }

    if ($filterEndDate) {
        $stmt->bindParam(':filter_end_date', $filterEndDate, PDO::PARAM_STR);
    }

    if ($filterType) {
        $stmt->bindParam(':filter_type', $filterType, PDO::PARAM_STR);
    }

    $stmt->execute();
    $donations = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
body {
    font-family: Arial, sans-serif;
}

h2 {
    color: #4B0082;
}

form {
    display: flex;
    flex-direction: row;
    
   
}

form label {
    margin-top: 10px;
    
}

form input[type="submit"] {
    
    margin-left: 10px;
    background-color: #4B0082;
    color: white;
    padding: 5px;
    border-radius: 5px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    border: 1px solid #4B0082;
    padding: 8px;
    text-align: left;
}

table th {
    background-color: #4B0082;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
</head>
<body>


<h2>Admin Dashboard</h2>

<!-- Filter form -->
<form method="post" action="">
    <label for="filter_start_date">Filter by Start Date:</label>
    <input type="date" id="filter_start_date" name="filter_start_date">

    <label for="filter_end_date">Filter by End Date:</label>
    <input type="date" id="filter_end_date" name="filter_end_date">

    <!-- Filter by Type dropdown -->
    <label for="filter_type">Filter by Type:</label>
    <select id="filter_type" name="filter_type">
        <option value="">All Types</option>
        <option value="blood">Blood</option>
        <option value="Clothes">Clothes</option>
        <option value="money">Money</option>
        <!-- Add other types as needed -->
    </select>

    <input id="filter" type="submit" value="Filter">
</form>


<!-- Display donations -->
<table border="1">
    <tr>
        

        <?php if ($filterType === 'blood'): ?>
            <th>Donation ID</th>
        <th>Donor ID</th>
        <th>Date</th>
        <th>Type</th>
        <th>Donor Name</th>
        <th>Donor Email</th>
            <th>Blood Type</th>
            <th>Medical Visit Date</th>
        <?php elseif ($filterType === 'Clothes'): ?>
            <th>Donation ID</th>
        <th>Donor ID</th>
        <th>Date</th>
        <th>Type</th>
        <th>Donor Name</th>
        <th>Donor Email</th>
            <th>Cloth Size</th>
            <th>Cloth Description</th>
            <th>Zip Code</th>
        <?php elseif ($filterType === 'money'): ?>
            <th>Donation ID</th>
        <th>Donor ID</th>
        <th>Date</th>
        <th>Type</th>
        <th>Donor Name</th>
        <th>Donor Email</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Transaction ID</th>
         <?php elseif ($filterType === ''): ?>
            <th>Donation ID</th>
        <th>Donor ID</th>
        <th>Date</th>
        <th>Type</th>
        <th>Donor Name</th>
        <th>Donor Email</th>

        <?php endif; ?>

    </tr>
    <?php foreach ($donations as $donation): ?>
        <tr>
            <td><?= $donation['Don_id'] ?></td>
            <td><?= $donation['Donor_id'] ?></td>
            <td><?= $donation['Donation_date'] ?></td>
            <td><?= $donation['Donation_type'] ?></td>
            <td><?= $donation['donor_nom'] . ' ' . $donation['donor_prenom'] ?></td>
            <td><?= $donation['donor_email'] ?></td>

            <?php if ($filterType === 'blood'): ?>
                <td><?= $donation['blood_type'] ?></td>
                <td><?= $donation['date_visite_medicale'] ?></td>
            <?php elseif ($filterType === 'Clothes'): ?>
                <td><?= $donation['taille'] ?></td>
                <td><?= $donation['descr'] ?></td>
                <td><?= $donation['zip_code'] ?></td>
            <?php elseif ($filterType === 'money'): ?>
                <td><?= $donation['montant'] ?></td>
                <td><?= $donation['methode_payment'] ?></td>
                <td><?= $donation['tran_id'] ?></td>
            <?php endif; ?>

        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
