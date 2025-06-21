<?php
session_start();
include_once('../config/database.php');


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['isAdmin'] !== 0) {
    header("Location: userlogin.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>

        #user-details {
            width: 80%; 
            margin: 20px auto; 
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #user-details th, #user-details td {
            border: 1px solid #ddd;
            padding: 12px; 
            text-align: left;
        }

        #user-details th {
            background-color: #f2f2f2; 
        }

        #user-details tr:nth-child(even) {
            background-color: #f9f9f9;
        }


        h2 {
            text-align: center; 
        }


        a {
            display: block;     
            text-align: center; 
            margin-bottom: 10px; 
        }
    </style>
</head>
<body>

    <h1>Welcome, 
        <?php
        try {
            $stmt = $conn->prepare("SELECT Username FROM User WHERE Email = :email");
            $stmt->bindParam(':email', $_SESSION['email']);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo htmlspecialchars($row['Username'] ?? "User"); 
        } catch (PDOException $e) {
            error_log("Error fetching username: " . $e->getMessage());
            echo "User";
        } 
        ?>!
    </h1>


    <h2 style="text-align: center;">Your Details</h2> 

    <table id="user-details">
        <?php
        try {
            $stmt = $conn->prepare("SELECT BloodType, PlasmaType, CityName FROM User u JOIN City c ON u.Location = c.CityID WHERE Email = :email");
            $stmt->bindParam(':email', $_SESSION['email']);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                
                foreach($row as $key => $value) {
                    echo "<tr><th>" . htmlspecialchars($key) . ":</th><td>" . htmlspecialchars($value) . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>User details not found. Please update your profile.</td></tr>";
            }
        } catch (PDOException $e) {
            error_log("Error fetching user details: " . $e->getMessage());
            echo "<tr><td colspan='2'>Error fetching user details. Please try again later.</td></tr>";
        }
        ?>
    </table>

    <a href="donate.html" style="text-align: center;">Donate Blood</a>
    <a href="search.html" style="text-align: center;">Search for Blood</a>
    <a href="myreport.php" style="text-align: center;">Medical Record</a>
    <a href="locationtest.html" style="text-align: center;">Find nearest center</a>
    <a href="logout.php" style="text-align: center;">Logout</a>

</body>
</html>
