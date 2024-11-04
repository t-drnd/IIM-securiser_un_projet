<?php
session_start();
require '../bdd.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);
$post = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
    $stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);
    header('Location: ../index.php');
}
?>
<form method="POST">
    <input type="text" name="title" value="<?= $post['title'] ?>" required>
    <textarea name="content" required><?= $post['content'] ?></textarea>
    <button type="submit">Mettre à jour</button>
</form>
