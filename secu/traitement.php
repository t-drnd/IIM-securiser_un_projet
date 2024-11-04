<?php

session_start();
require_once 'bdd.php';

if (!isset($_POST['token']) || !isset($_SESSION['csrf_article_add']) || $_POST['token'] != $_SESSION['csrf_article_add']) {
    die('<p>CSRF invalide</p>');
}

unset($_SESSION['csrf_article_add']);

unset($_SESSION['csrf_article_add']);

if (isset($_POST['title']) && !empty($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
} else {
    echo "<p>Le titre est obligatoire</p>";
}

if (isset($_POST['content']) && !empty($_POST['content'])) {
    $content = htmlspecialchars($_POST['content']);
} else {
    echo "<p>Le contenu est obligatoire</p>";
}

if (isset($_POST['slug']) && !empty($_POST['slug'])) {
    $slug = htmlspecialchars($_POST['slug']);
} else {
    echo "<p>Le slug est obligatoire</p>";
}

if (isset($title) && isset($content) && isset($slug)) {

    $sauvegarde = $pdo->prepare(
        'INSERT INTO Article (title, content, slug) VALUES (:title, :content, :slug)'
    );
    $sauvegarde->execute([
        'title' => $title,
        'content' => $content,
        'slug' => $slug
    ]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Sauvegarde effectué</p>";
    } else {
        echo "<p>Une erreur est survenue</p>";
    }
}
