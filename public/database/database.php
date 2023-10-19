<?php
$driver = 'mysql';
$host = 'localhost';
$db_name = 'testing';
$db_user = 'root';
$db_pass = '123456';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];  // Убираем дублирование при выводе

try {
    return $pdo = new PDO(
        "$driver:host=$host;dbname=$db_name;charset=$charset",
        $db_user,
        $db_pass,
        $options
    );
} catch (PDOException $i){
    die("Ошибка подключения к базе данных");
}



//$link = mysqli_connect("localhost", "root", "");
//
//if ($link === false){
//    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
//}
//else {
//    print("Соединение установлено успешно");
//}
