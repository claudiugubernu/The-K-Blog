<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    // Check if database credentials are provided
    if (empty($_SESSION['server_name']) || empty($_SESSION['db_name']) || empty($_SESSION['db_username']) || empty($_SESSION['db_password'])) {
        include('./setup-cms.php');
        exit;
    } else {
        // Attempt to connect to the database
        $pdo = new PDO('mysql:host=$_SESSION["server_name"];dbname=$_SESSION["db_name"]', $_SESSION['db_username'], $_SESSION['db_password']);
        // Set error mode
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (PDOException $e) {
    // If any errors occur, run setup page
    include('./setup-cms.php');
    exit;
}
?>