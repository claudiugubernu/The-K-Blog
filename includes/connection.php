<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=the_k_blog', 'root', 'klausdev');
} catch (PDOException $e) {
    exit('Database error.');
}
