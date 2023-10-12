<?php

session_start();

$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['login'] = $_POST['login'];
$_SESSION['email'] = $_POST['email'];

/** @var PDO $pdo */
$pdo = require_once __DIR__ . '/../database/database.php'; // подключаю файл с бд

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // проверяю, что все необходимые данные в $_POST есть
    exit("Эт не пост");
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['username'], $data['password'], $data['login'], $data['email'])) {
    // отправляю сообщение об ошибке
    echo json_encode(['status' => 'error', 'message' => 'Необходимо заполнить все поля'], JSON_UNESCAPED_UNICODE);
    exit();
}

$name = $data['username'];
$pass = $data['password'];
$login = $data['login'];
$email = $data['email'];

// генерирую случайную соль
$salt = random_bytes(16);

// хеширую пароль с солью
$hashedPassword = password_hash($pass . $salt, PASSWORD_BCRYPT);

// добавляю валидацию данных
if (empty($name)) {
    echo json_encode(['status' => 'error', 'message' => 'Имя не может быть пустым'], JSON_UNESCAPED_UNICODE);
    exit();
} elseif (iconv_strlen($name) < 3) {
    echo json_encode(['status' => 'error', 'message' => 'Имя должно содержать не менее 3 символов'], JSON_UNESCAPED_UNICODE);
    exit();
} elseif (iconv_strlen($pass) < 5) {
    echo json_encode(['status' => 'error', 'message' => 'Пароль должен содержать не менее 5 символов'], JSON_UNESCAPED_UNICODE);
    exit();
} elseif (iconv_strlen($login) < 5) {
    echo json_encode(['status' => 'error', 'message' => 'Логин должен содержать не менее 5 символов'], JSON_UNESCAPED_UNICODE);
    exit();
} elseif (iconv_strlen($email) < 3 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Неверный формат Email'], JSON_UNESCAPED_UNICODE);
    exit();
}
// вставляю данные в базу данных, включая хеш пароля и соль
$sql = 'INSERT INTO users (name, password, salt, login, email) VALUES (?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);

if ($query->execute([$name, $hashedPassword, $salt, $login, $email])) {
    // отправляю успешный ответ
    echo json_encode(['status' => 'success', 'message' => 'Регистрация прошла успешно'], JSON_UNESCAPED_UNICODE);
} else {
    // отправляю сообщение об ошибке
    echo json_encode(['status' => 'error', 'message' => 'Ошибка при выполнении запроса'], JSON_UNESCAPED_UNICODE);
}

