<?php
include_once('includes/connection.php');

// Prepare query to get settings from DB
$query = $pdo->prepare('SELECT * FROM cms_settings');
$query->execute();

// Get all CMS settings and assign them
$cms_settings = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if($cms_settings) { echo $cms_settings[0]['site_title']; } else { echo 'Blog'; } ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="./admin/<?php echo $cms_settings[0]['site_icon'] ?>"/>
        <link rel="stylesheet" href="static/app.css" />
    </head>
        <body>
        