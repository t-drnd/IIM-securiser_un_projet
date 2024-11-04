<?php
session_start();
require '../bdd.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
    $stmt->execute(['title' => $title, 'content' => $content]);
    header('Location: ../index.php');
}
?>
<form method="POST">
    <input type="text" name="title" placeholder="Titre" required>
    <textarea name="content" placeholder="Contenu" required></textarea>
    <button type="submit">Ajouter</button>
</form>
