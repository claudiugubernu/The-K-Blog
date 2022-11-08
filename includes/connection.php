<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=the_k_blog', 'root', 'klausdev');
} catch (PDOException $e) {
    // If error code 1049 (no matching the_k_blog database found) start Setup CMS
    $eCode = $e->getCode();
    if($eCode === 1049) {
        include('./setup-cms.php');
        exit;
    } else {
        exit('Database connection error.');
    }
}
?>