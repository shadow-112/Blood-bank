
<!DOCTYPE html>
<html>
<head>
    <title>Donate</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>

<?php
include_once('../config/database.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donorName = trim($_POST['donor_name']);
    $userId = $_SESSION['UserID']; 
    $cityId = $_POST['city']; 
    $centerId = $_POST['center']; 
    $donationType = $_POST['donationType'];
    $donationDate = $_POST['donationDate']; 

    try {

        $bloodTypeSql = "SELECT BloodType FROM User WHERE UserID = ?";
        $bloodTypeStmt = $conn->prepare($bloodTypeSql);
        $bloodTypeStmt->bindParam(1, $userId, PDO::PARAM_INT);
        $bloodTypeStmt->execute();
        $bloodType = $bloodTypeStmt->fetchColumn();
        $donationSql = "INSERT INTO Donation (UserID, CenterID, DonationType, DonationDate, DonorName, CityID, BloodType) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $donationStmt = $conn->prepare($donationSql);
        $donationStmt->bindParam(1, $userId, PDO::PARAM_INT); 
        $donationStmt->bindParam(2, $centerId, PDO::PARAM_INT); 
        $donationStmt->bindParam(3, $donationType, PDO::PARAM_STR);
        $donationStmt->bindParam(4, $donationDate, PDO::PARAM_STR); 
        $donationStmt->bindParam(5, $donorName, PDO::PARAM_STR); 
        $donationStmt->bindParam(6, $cityId, PDO::PARAM_INT); 
        $donationStmt->bindParam(7, $bloodType, PDO::PARAM_STR);
        $donationStmt->execute();
        $donationId = $conn->lastInsertId();

  
        $inventorySql = "INSERT INTO Inventory (DonationId, UserID, CenterID, DonationDate, DonationType, CityID, BloodType)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $inventoryStmt = $conn->prepare($inventorySql);
        $inventoryStmt->bindParam(1, $donationId, PDO::PARAM_INT);
        $inventoryStmt->bindParam(2, $userId, PDO::PARAM_INT);
        $inventoryStmt->bindParam(3, $centerId, PDO::PARAM_INT); 
        $inventoryStmt->bindParam(4, $donationDate, PDO::PARAM_STR); 
        $inventoryStmt->bindParam(5, $donationType, PDO::PARAM_STR);
        $inventoryStmt->bindParam(6, $cityId, PDO::PARAM_INT); 
        $inventoryStmt->bindParam(7, $bloodType, PDO::PARAM_STR);
        $inventoryStmt->execute();

        echo "Registration successful!";
    } catch (PDOException $e) {
        echo "Error during donation: " . $e->getMessage();
    }
}
?>
