<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=the_k_blog', 'root', 'KlausDev23!');
} catch (PDOException $e) {
    // If any errors occur run setup page
    include('./setup-cms.php');
    exit;
}
?>