<?php
$dsn = 'localhost';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=localhost; dbname=IIM-securiser;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

?>
