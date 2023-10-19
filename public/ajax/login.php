<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/** @var PDO $pdo */
$pdo = require_once __DIR__ . '/../database/database.php'; // подключаю файл с бд

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // проверяю, что все необходимые данные в $_POST есть
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $pass = $_POST['password'];

        if (empty($login) || empty($pass)) {
            echo json_encode(['status' => 'error', 'message' => 'Логин и пароль не могут быть пустыми']);
            exit();
        }

        // Получаю хеш и соль из базы данных для данного пользователя для поля логин
        $sql = 'SELECT id, password, salt FROM users WHERE login = :login';
        $query = $pdo->prepare($sql);
        $query->bindParam(':login', $login);
        $query->execute();
        $userData = $query->fetch();

        // добавляю валидацию данных
        if ($userData) {
            $storedHashedPassword = $userData['password'];
            $storedSalt = $userData['salt'];
            // сравниваю введенный пароль с хешем и солью
            if (password_verify($pass . $storedSalt, $storedHashedPassword)) {
                // Успешная аутентификация
                $_SESSION['user_id'] = $userData['id'];
                echo json_encode(['status' => 'success', 'message' => 'Авторизация прошла успешно']);
            } else {
                // Отправляем сообщение об ошибке
                echo json_encode(['status' => 'error', 'message' => 'Неверный логин или пароль']);
            }
        } else {
            // Отправляем сообщение об ошибке
            echo json_encode(['status' => 'error', 'message' => 'Необходимо заполнить все поля']);
        }
    }
}





