<?php
if (isset($_GET['page'])){
    $page = $_GET['page'];
    /** @var PDO $pdo */
    $pdo = require_once __DIR__ . '/ajax/database.php';

    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->bindParam(':id', $page);
    $stmt->execute();
    $article_data = $stmt->fetch(); // [id, title, content]
    if($article_data === false){
        die('Такой статьи пока нет. Напишешь?');
    }
    echo $article_data['content'];
} else {
    die('ПНХ такой статьи нет');
}
