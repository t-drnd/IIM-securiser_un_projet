<?php
require_once 'bdd.php';
session_start();
if(
    !isset($_SESSION['csrf_article_add']) || 
    empty($_SESSION['csrf_article_add'])
){
    $_SESSION['csrf_article_add'] = bin2hex(string: random_bytes(length: 32));
}

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $role = $_SESSION['user']['role'];

    echo "<p>Bienvenue, $username ! Votre rôle : $role</p>";
    echo '<a href="logout.php">Se déconnecter</a>';
} else {
    echo "<p>Vous n'êtes pas connecté. <a href='login.php'>Connexion</a></p>";
}

$sql = "SELECT * FROM articles ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($articles) {
    foreach ($articles as $article) {
        echo "<h2>" . htmlspecialchars($article['title']) . "</h2>";
        echo "<p>" . htmlspecialchars($article['content']) . "</p>";
    }
} else {
    echo "<p>Aucun article trouvé.</p>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="traitement.php" method="POST">
        <label for="title">Titre : </label>
        <input type="text" name="title" id="title" placeholder="Article 1">
        <br>
        <label for="content">Contenu : </label>
        <textarea name="content" id="content" rows="10" cols="30"></textarea>
        <br>
        <label for="slug">Slug : </label>
        <input type="text" name="slug" id="slug" placeholder="article-1">
        <br>
        <input type="hidden" name="token" value="<?= $_SESSION ['csrf_article_add']; ?>">
        <input type="submit" name="ajouter" value="Ajouter">
    </form>

    <h1>Articles</h1>
    <?php foreach ($articles as $article): ?>
        <h2><?= htmlspecialchars($article['title']) ?></h2>
        <p><?= htmlspecialchars($article['content']) ?></p>
    <?php endforeach; ?>

</body>
</html>
