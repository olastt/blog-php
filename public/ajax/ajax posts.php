<?php

session_start();
//$author = $_SESSION['user_id'] ?? null;
//
//if (is_null($author)) {
//    echo 'Как ты сюда попал? Ты кто такой? Я тебя не знаю';
//    die();
//}
//$author = $_SESSION['username'] ?? null;
//var_dump($_SESSION);


/** @var PDO $pdo */
$pdo = require_once __DIR__ . '/../database/database.php'; // Подключаем файл с подключением к БД

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяю, что все необходимые данные в $_POST есть
    if (isset($_POST['title'], $_POST['content'], $_SESSION['user_id'])) {
        // Получаем данные о статье из $_POST
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $author_id = htmlspecialchars($_SESSION['user_id']); // Ваш код вернет идентификатор автора из сессии

        // Добавляем валидацию данных
        if (empty($title) || iconv_strlen($title) < 3) {
            echo json_encode(['status' => 'error', 'message' => 'Введите название статьи (не менее 3 символов)']);
            exit();
        } elseif (empty($content) || iconv_strlen($content) <= 20) {
            echo json_encode(['status' => 'error', 'message' => 'Текст статьи должен содержать не менее 20 символов']);
            exit();
        }

        // Вставляем данные в базу данных с информацией об авторе
        $sql = 'INSERT INTO posts (title, content, author_id) VALUES (?, ?, ?)';
        $query = $pdo->prepare($sql);

        if ($query->execute([$title, $content, $author_id])) {
            // Отправляем успешный ответ
            echo json_encode(['status' => 'success', 'message' => 'Статья успешно добавлена']);
            exit();
        } else {
            // Отправляем сообщение об ошибке
            echo json_encode(['status' => 'error', 'message' => 'Ошибка при выполнении запроса']);
            exit();
        }
    } else {
        // Отправляем сообщение об ошибке, если не хватает данных
        echo json_encode(['status' => 'error', 'message' => 'Недостаточно данных']);
        exit();
    }
}
