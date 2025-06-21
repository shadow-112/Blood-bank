<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
  
        $stmt = $conn->prepare("SELECT * FROM User WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $password==$row['Password']) {

            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['isAdmin'] = $row['isAdmin'];
            $_SESSION['Username'] = $row['Username']; 
            $_SESSION['UserID'] = $row['UserID'];

            if ($row['isAdmin']) {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {

            header("Location: login.php?error=Invalid email or password."); 
            exit();
        }

    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        header("Location: login.php?error=An error occurred during login.");
    }
}
?>
