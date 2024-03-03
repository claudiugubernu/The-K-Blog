<?php

session_start();

try {
    $conn = new PDO('mysql:host=' . $_SESSION["server_name"], $_SESSION["db_username"], $_SESSION["db_password"]);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Create DB if doesn't exists
    $sql = "CREATE DATABASE IF NOT EXISTS {$_SESSION["db_name"]};";
    // Select DB created
    $sql .= "USE {$_SESSION['db_name']};";
    // Create users table
    $sql .="DROP TABLE IF EXISTS `users`;";
    $sql .= "CREATE TABLE `users` (
        `user_id` INT NOT NULL AUTO_INCREMENT,
        `user_name` varchar(255) NOT NULL,
        `user_email` varchar(255) NOT NULL,
        `user_password` varchar(255) NOT NULL,
        `user_secret_word` varchar(255) NOT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
    // Insert in users table
    $sql .= "INSERT INTO `users` VALUES (1,'$admin_user','$admin_email','$admin_password','$secret_word','2022-02-15 22:54:34');";
    
    // Create posts table
    $sql .="DROP TABLE IF EXISTS `posts`;";
    $sql .= "CREATE TABLE `posts` (
    `post_id` int NOT NULL AUTO_INCREMENT,
    `post_title` varchar(255) NOT NULL,
    `post_content` text NOT NULL,
    `post_thumbnail_path` varchar(255) DEFAULT NULL,
    `post_timestamp` int DEFAULT NULL,
    PRIMARY KEY (`post_id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";

  // Create cms_settings table
  $sql .="DROP TABLE IF EXISTS `cms_settings`;";
  $sql .="CREATE TABLE `cms_settings` (
    `site_icon` varchar(255) DEFAULT NULL,
    `site_title` varchar(255) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
  $sql .="INSERT INTO `cms_settings` VALUES ('./uploads/k-favicon.png','My Blog');";
  
 // use exec() because no results are returned
  $conn->exec($sql);
  header('Location: index.php');
} catch(PDOException $e) {
  $error = 'Unexpected error. Please try again!';
  // echo $e->getMessage();
}

$conn = null;
?>
