<?php
session_start();


include_once('../config/database.php');


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['isAdmin'] !== 1) {
    header("Location: adminlogin.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        #inventory-summary table, #recent-donations table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Welcome, Admin!</h1>

    <h2 style="text-align: center;">Inventory Summary</h2>
    <div id="inventory-summary">
        <?php
        try {
            $stmt = $conn->query("SELECT BloodType, COUNT(*) AS Count FROM Inventory GROUP BY BloodType");
            $inventorySummary = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($inventorySummary)) {
                echo "<table id='inventory-table'>";
                echo "<tr><th>Blood Type</th><th>Count</th></tr>";
                foreach ($inventorySummary as $row) {
                    echo "<tr><td>" . htmlspecialchars($row['BloodType'], ENT_QUOTES, 'UTF-8') . 
                         "</td><td>" . htmlspecialchars($row['Count'], ENT_QUOTES, 'UTF-8') . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No inventory data found.</p>";
            }
        } catch (PDOException $e) {
            error_log("Error fetching inventory: " . $e->getMessage()); 
            echo "<p>Error fetching inventory summary.</p>"; 
        }
        ?>
    </div>

    <h2 style="text-align: center;">Recent Donations</h2>
    <div id="recent-donations">
        <?php
        try {
            $stmt = $conn->query("SELECT DonorName, DonationDate, BloodType FROM Donation ORDER BY DonationDate DESC LIMIT 10");
            $recentDonations = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($recentDonations)) {
                echo "<table id='donations-table'>";
                echo "<tr><th>Donor Name</th><th>Donation Date</th><th>Blood Type</th></tr>";
                foreach ($recentDonations as $row) {
                    echo "<tr><td>" . htmlspecialchars($row['DonorName'], ENT_QUOTES, 'UTF-8') .
                         "</td><td>" . htmlspecialchars($row['DonationDate'], ENT_QUOTES, 'UTF-8') . 
                         "</td><td>" . htmlspecialchars($row['BloodType'], ENT_QUOTES, 'UTF-8') . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No recent donations found.</p>";
            }
        } catch (PDOException $e) {
            error_log("Error fetching donations: " . $e->getMessage());  
            echo "<p>Error fetching recent donations.</p>"; 
        }
        ?>
    </div>
    

    <a href="useDonation.php">Manage Donations</a><br>
    <a href="MedicalReport.html">Medical Reports</a><br>
    <a href="user_info.php">Registered Users</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>
