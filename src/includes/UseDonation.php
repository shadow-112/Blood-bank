<!DOCTYPE html>
<html>
<head>
    <title>Use Donation</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
    <div class="new-container">
        <?php
        include_once('../config/database.php'); 

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $inventorySql = "SELECT * FROM Inventory";
                $inventoryStmt = $conn->query($inventorySql);
                $inventory = $inventoryStmt->fetchAll(PDO::FETCH_ASSOC); 

                echo "<h1>Inventory</h1>";
                echo "<table>";
                echo "<tr><th>DonationId</th><th>UserID</th><th>CenterID</th><th>DonationDate</th><th>DonationType</th><th>CityID</th><th>BloodType</th></tr>";
                foreach ($inventory as $item) {
                    echo "<tr>";
                    echo "<td>" . $item['DonationID'] . "</td>";
                    echo "<td>" . $item['UserID'] . "</td>";
                    echo "<td>" . $item['CenterID'] . "</td>";
                    echo "<td>" . $item['DonationDate'] . "</td>";
                    echo "<td>" . $item['DonationType'] . "</td>";
                    echo "<td>" . $item['CityID'] . "</td>";
                    echo "<td>" . $item['BloodType'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                // Form to select a donation to use
                echo "<h1>Select a Donation to Use</h1>";
                echo "<form method='POST' action=''>";
                echo "<label for='donationId'>Donation ID:</label><br>";
                echo "<input type='number' id='donationId' name='donationId'><br>";
                echo "<input type='submit' value='Use Donation'>";
                echo "</form>";
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['donationId'])) {
                // Handle donation usage
                $selectedDonationId = $_POST['donationId'];

                // Remove donation from inventory
                $deleteSql = "DELETE FROM Inventory WHERE DonationID = ?";
                $deleteStmt = $conn->prepare($deleteSql);
                $deleteStmt->execute([$selectedDonationId]);

                echo "<p>Donation with ID $selectedDonationId marked as used and removed from inventory.</p>";
                
            } 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
