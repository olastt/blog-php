<?php
$driver = 'mysql';
$host = $_SERVER['MYSQL_SERVER_NAME'];
$db_name = $_SERVER['MYSQL_DATABASE'];
$db_user = $_SERVER['MYSQL_USER1'];
$db_pass = $_SERVER['MYSQL_USER1_PASSWORD'];
$charset = 'utf8';
$port = $_SERVER['MYSQL_PORT_INTERNAL'];
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];  // Убираем дублирование при выводе

try {
    return $pdo = new PDO(
        "$driver:host=$host;port=$port;dbname=$db_name;charset=$charset",
        $db_user,
        $db_pass,
        $options
    );
} catch (PDOException $i){
    die("Ошибка подключения к базе данных");
}
