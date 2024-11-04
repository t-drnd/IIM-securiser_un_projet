<?php
// http://127.0.0.1:8888/article.php?s=testV1
require_once 'bdd.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM article WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(!isset($_GET['s']) || empty($_GET['s'])){
    die('<p>Article introuvable</p>');
}

$getArticle = $connexion->prepare(
    query: 'SELECT title, content FROM Article WHERE slug = :slug
    LIMIT 1'
);
$getArticle->execute(params: [
    'slug' => htmlspecialchars(string: $_GET['s'])
]);

if($getArticle->rowCount() == 1){
    $article = $getArticle->fetch();
    echo '<h1>'. $article['title'] . '</h1>';
    echo '<p>'. $article['content'] . '</p>';
}
else{
    echo '<p>Article introuvable</p>';
}