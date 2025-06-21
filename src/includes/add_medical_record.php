<?php
session_start();

require_once '../config/database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userid'];
    $medicalHistory = $_POST['medicalhistory'];
    $lastCheckupDate = $_POST['lastcheckupdate'];

    $doctorName = $_SESSION['Username'];

    try {
        $sql = "INSERT INTO MedicalRecord (UserID, MedicalHistory, LastCheckupDate, DoctorName) 
                VALUES (:userid, :medicalhistory, :lastcheckupdate, :doctorname)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userId);
        $stmt->bindParam(':medicalhistory', $medicalHistory);
        $stmt->bindParam(':lastcheckupdate', $lastCheckupDate);
        $stmt->bindParam(':doctorname', $doctorName);

        $stmt->execute();

        echo "Medical record added successfully!";
        exit(); 

    } catch (PDOException $e) {

        die("Error adding medical record: " . $e->getMessage());
    }
}
?>
