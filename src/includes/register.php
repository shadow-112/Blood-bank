<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../config/database.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bloodType = $_POST['bloodtype'];
    $plasmaType = $_POST['plasmatype'];
    $city = $_POST['city'];
    $email = $_POST['email']; 

    try {
        
        $stmt = $conn->prepare("INSERT INTO User (Username, Password, BloodType, PlasmaType, Location, Email) 
                                VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->bindParam(3, $bloodType, PDO::PARAM_STR);
        $stmt->bindParam(4, $plasmaType, PDO::PARAM_STR);
        $stmt->bindParam(5, $city, PDO::PARAM_STR);
        $stmt->bindParam(6, $email, PDO::PARAM_STR); 

        if ($stmt->execute()) {
            $userId = $conn->lastInsertId();
            echo "Registration successful! Your User ID is: " . $userId; 
        } else {
            echo "Error during registration: " . $conn->errorInfo()[2]; 
        }

    } catch (PDOException $e) {
        echo "Error during registration: " . $e->getMessage();
    }
}
?>
