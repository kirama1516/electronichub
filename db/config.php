<!-- -- Active: 1734449102297@@127.0.0.1@3306@electronic_hub -->
<?php

session_start(); // Start the session

$dsn = 'mysql:host=localhost;dbname=electronic_hub';
$username = 'admin';
$password = '6680Afa.';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>
