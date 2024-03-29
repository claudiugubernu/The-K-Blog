<?php
include_once('../includes/connection.php');

// Prepare query to get settings from DB
$query = $pdo->prepare('SELECT * FROM cms_settings');
$query->execute();

// Get all CMS settings and assign them
$cms_settings = $query->fetchAll();
// Global var to check if looged in
$logged_in = 'logged-in';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if($cms_settings) { echo $cms_settings[0]['site_title']; } else { echo 'Blog'; } ?> - Admin</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $cms_settings[0]['site_icon'] ?>"/>
        <link rel="stylesheet" href="../static/app.css"/>
        <link rel="stylesheet" href="./widgets/calendar.css"/>
    </head>
        <body class="<?php if (isset($_SESSION["logged_in"])) { ?>admin-bg-primary<?php } else { ?>admin-bg-secondary<?php } ?>">
        <?php 
            if (isset($_SESSION["logged_in"])) { 
                $username = $_SESSION['username'];
                include('./templates/admin-welcome.php');
            } 
        ?>