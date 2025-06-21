
<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>

<?php

require_once '../config/database.php';

$sql = "SELECT CENTER.CenterName, Inventory.BloodType, Inventory.DonationType, Inventory.DonationID
        FROM Inventory 
        JOIN CENTER ON Inventory.CenterID = CENTER.CenterID"; 

try {
    $stmt = $conn->prepare($sql);
} catch (PDOException $e) {
    echo "Error preparing statement: " . $e->getMessage();
    exit;
}

try {
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error retrieving inventory: " . $e->getMessage();
    exit;
}
if ($stmt->rowCount() > 0) {
    echo "<h2>Current Inventory</h2>";
    echo "<table>";
    echo "<tr><th>Donation ID</th><th>Blood Type</th><th>Center Name</th><th>Donation Type</th></tr>"; 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         echo "<tr>";
         echo "<td>" . htmlspecialchars($row['DonationID']). "</td>";
         echo "<td>" . htmlspecialchars($row['BloodType']) . "</td>";
         echo "<td>" . htmlspecialchars($row['CenterName']) . "</td>";
         echo "<td>" . htmlspecialchars($row['DonationType']) . "</td>";
         echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Inventory is empty.";
}

$stmt = null; // Close the statement
?>
