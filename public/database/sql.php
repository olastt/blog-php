<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>PHP</title>
</head>
<body>
<?php
$driver = 'mysql';
$host = 'mysql';
$db_name = 'testing';
$db_user = 'root';
$db_pass = '123456';
$charset = 'utf8';
//$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];  // Убираем дублирование при выводе

$dsn = 'mysql:host='.$host.';dbname='.$db_name;
$pdo = new PDO($dsn, $db_user, $db_pass);


//echo 'Выборка всех пользователей из таблицы';
////выборка всех пользователей из таблицы users
//// по определенным параметрам
//$query = $pdo->query('SELECT * FROM `users`  ORDER BY `id` DESC LIMIT 3');
//while($row = $query->fetch(PDO::FETCH_ASSOC)) {
//    echo  '<h3>' . '<p>Имя: ' . $row['name'] . '<br>' . '<p>Логин: ' . $row['login'] .'<br>' . '<p>Почта: ' . $row['email'] .'</h3>' . '<br>';
//}
//
//echo 'Выборка пользователей по параметрам' . '<br>';

// выборка определенного параметра с выводом всех
// совпадений из таблицы (1-ый вариант)
// fetchAll - вывод всех совпадений
//$name = 'klancy';
//$email = '';
$id = 211;
//$sql = 'SELECT `name`, `email` FROM `users` WHERE `name` = :name && `id` >= :id';
//$query = $pdo->prepare($sql);
//$query->execute(['name' => $name, 'id' => $id]);
//$users = $query->fetchAll(PDO::FETCH_OBJ);
////var_dump($users); просмотр, вывелось ли
//
//foreach ($users as $user) {
//    echo '<h3>' . '<p>Имя: ' . $user->name . '<p>Почта: ' .$user->email . '</h3>';
//}


// 2-ой вариант с выводом одной строки одного юзера
// с первым совпадением
// fetch - вывод одного совпадения
//$sql = 'SELECT * FROM `users` WHERE `id` =:id';
//$query = $pdo->prepare($sql);
//$query->execute(['id' => $id]);
//$user = $query->fetch(PDO::FETCH_OBJ);
//
//echo $user->email . '<br>';


//echo 'Создание нового юзера' . '<br>';
//
//$name = 'testov';
//$password = 'вввц';
//$login = 'winxz';
//$email = 'winx1998@gmail.com';
//$salt = random_bytes(16);
//$hashedPassword = password_hash($password . $salt, PASSWORD_BCRYPT);
//var_dump($hashedPassword); //решить проблему с паролем!!
//$sql = 'INSERT INTO `users` (name, password, login, email, salt) VALUES(:name, :password, :login, :email, :salt)';
//$query = $pdo->prepare($sql);
//$query->execute(['name' => $name, 'password' => $password, 'login' => $login, 'email' => $email, 'salt' => $salt]);


//echo 'Изменение значений у юзера в таблице' . '<br>';
//$id = 223;
//$login = 'New login';
//$email = 'ohmy@mail.ru';
//$sql = 'UPDATE `users` SET `login` = :login, `email` = :email WHERE `id` =:id';
//$query = $pdo->prepare($sql);
//$query ->execute(['login' => $login, 'id' => $id, 'email' => $email]);

echo 'Удаление данных о юзере' . '<br>';
$id = 222;
$sql = 'DELETE FROM `users` WHERE `id` = ?';
$query = $pdo->prepare($sql);
$query->execute([$id]);
?>
</body>
</html>
