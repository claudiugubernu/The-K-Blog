<?php

// Include db_connection variables here.
$server_name = '';
$db_name = '';
$db_username = '';
$db_password = '';

try {
    // Check if database credentials are provided
    if (empty($server_name) || empty($db_name) || empty($db_username)) {
        include_once('./setup-cms.php');
    } else {
        // Attempt to connect to the database
        $pdo = new PDO("mysql:host=$server_name;dbname=$db_name", $db_username, $db_password);
        // Set error mode
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (PDOException $e) {
    // If any errors occur, run setup page
    include_once('./setup-cms.php');
    exit;
}
?>
