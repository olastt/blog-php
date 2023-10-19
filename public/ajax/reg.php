<?php
session_start();
/** @var PDO $pdo */
$pdo = require_once __DIR__ . '/../database/database.php'; // подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // проверяем, что все необходимые данные в $_POST есть
    if (isset($_POST['username'], $_POST['password'], $_POST['login'], $_POST['email'])) {
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $login = $_POST['login'];
        $email = $_POST['email'];

        // генерируем случайную соль
        $salt = random_bytes(16);

        // хешируем пароль с солью
        $hashedPassword = password_hash($pass . $salt, PASSWORD_BCRYPT);

        // добавляем валидацию данных
        if (empty($name) || iconv_strlen($name) < 3) {
            echo json_encode(['status' => 'error', 'message' => 'Имя не может быть пустым']);
            exit();
        } elseif (iconv_strlen($pass) < 5) {
            echo json_encode(['status' => 'error', 'message' => 'Пароль должен содержать не менее 5 символов']);
            exit();
        } elseif (iconv_strlen($login) < 5) {
            echo json_encode(['status' => 'error', 'message' => 'Логин должен содержать не менее 5 символов']);
            exit();
        } elseif (iconv_strlen($email) < 3 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Неверный формат Email']);
            exit();
        }

        // вставляем данные в базу данных, включая хеш пароля и соль
        $sql = 'INSERT INTO users (name, password, salt, login, email) VALUES (?, ?, ?, ?, ?)';
        $query = $pdo->prepare($sql);

        if ($query->execute([$name, $hashedPassword, $salt, $login, $email])) {
            // добавляем нового пользователя в таблицу authors
            $insertQuery = $pdo->prepare('INSERT INTO authors (login, password) VALUES (?, ?)');
            if ($insertQuery->execute([$login, $hashedPassword])) {
                echo json_encode(['status' => 'success', 'message' => 'Регистрация прошла успешно']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ошибка при выполнении запроса']);
                exit();
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Ошибка при выполнении запроса']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Необходимо заполнить все поля']);
        exit();
    }
}
