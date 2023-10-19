<?php
session_start();

$author = $_SESSION['username'] ?? null;
//var_dump($_SESSION);

// подключение к базе данных и проверка аутентификации пользователя
$pdo = require_once __DIR__ . '/../database/database.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // выполняю SQL-запрос для получения постов пользователя
    $sql = "SELECT * FROM posts WHERE author_id = :user_id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':user_id', $user_id);
    $query->execute();
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);

    // отправляю посты в формате JSON
} else {
    echo json_encode(['status' => 'error', 'message' => 'Пользователь не аутентифицирован']);
}
