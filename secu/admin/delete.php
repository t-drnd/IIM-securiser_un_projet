<?php
session_start();
require '../bdd.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);
header('Location: ../index.php');
?>
