
<!DOCTYPE html>
<html>
<head>
    <title>Search For Blood</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $bloodType = $_POST['bloodtype']; 
   $cityID = $_POST['city']; 
   $donationType = $_POST['donationType'];

   $sql = "SELECT CENTER.CenterName, Inventory.BloodType, Inventory.DonationType
           FROM Inventory 
           JOIN CENTER ON Inventory.CenterID = CENTER.CenterID
           WHERE Inventory.BloodType = :bloodType AND CENTER.CityID = :cityID";
 
        $sql .= " AND Inventory.DonationType = :donationType";


   try {
       $stmt = $conn->prepare($sql);
   } catch (PDOException $e) {
       echo "Error preparing statement: " . $e->getMessage();
       exit;
   }

   $stmt->bindParam(':bloodType', $bloodType, PDO::PARAM_STR); 
   $stmt->bindParam(':cityID', $cityID, PDO::PARAM_INT); 
    $stmt->bindParam(':donationType', $donationType, PDO::PARAM_STR);

   try {
       $stmt->execute();
   } catch (PDOException $e) {
       echo "Error searching for blood: " . $e->getMessage();
      exit;
   }
   if ($stmt->rowCount() > 0) {
       echo "<h2>Available Donations:</h2>";
       echo "<table>";
       echo "<tr><th>Blood Type</th><th>Center Name</th><th>Donation Type</th></tr>";
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           echo "<tr>";
           echo "<td>" . htmlspecialchars($row['BloodType']) . "</td>";
           echo "<td>" . htmlspecialchars($row['CenterName']) . "</td>";
           echo "<td>" . htmlspecialchars($row['DonationType']) . "</td>";
           echo "</tr>";
       }
       echo "</table>";
   } else {
       echo "No matching blood found.";
   }

   $stmt = null; 
}
?>
