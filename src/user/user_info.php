<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css"> </head>
<body>
    <?php
    require_once '../config/database.php';

    // Correct variable name from $conn to $pdo 
    $sql = "SELECT UserID, Username, Location FROM user";

    try {
        $stmt = $conn->prepare($sql); // Use $pdo
    } catch (PDOException $e) {
        die("Error preparing statement: " . $e->getMessage());
    }

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error retrieving user information: " . $e->getMessage());
    }
    ?>
    <div class="form-container"> <h2>User Information</h2>
        <?php
        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>User ID</th><th>Username</th><th>City</th></tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['UserID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Location']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }
        ?>
    </div>

</body>
</html>
