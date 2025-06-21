<?php
session_start();

require_once '../config/database.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    die("Error: You must be logged in to view your medical history.");
}

$userId = $_SESSION['UserID']; // Assuming UserID is stored in the session after login

$sql = "SELECT MedicalHistory, LastCheckupDate, DoctorName
        FROM MedicalRecord 
        WHERE UserID = :userid"; // Ensure table and column names are correct

// Start outputting the HTML structure
echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '    <title>My Medical Records</title>';
echo '    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">';  // Link the stylesheet
echo '</head>';
echo '<body>';

try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userid', $userId);
    $stmt->execute();

    $medicalRecords = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all records

    if (count($medicalRecords) > 0) {
        echo '<div class="form-container">'; // Wrap in container for styling
        echo "<h1>My Medical Records</h1>";
        echo "<table>";
        echo "<tr><th>Medical History</th><th>Last Checkup Date</th><th>Doctor Name</th></tr>";

        foreach ($medicalRecords as $record) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($record['MedicalHistory']) . "</td>";
            echo "<td>" . htmlspecialchars($record['LastCheckupDate']) . "</td>";
            echo "<td>" . htmlspecialchars($record['DoctorName']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo '</div>'; // Close the container
    } else {
        echo "<p>No medical records found.</p>";
    }
} catch (PDOException $e) {
    die("Error fetching medical records: " . $e->getMessage());
}

// Close the HTML structure
echo '</body>';
echo '</html>';
