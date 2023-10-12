<?php
session_start();

//$author = $_SESSION['user_id'] ?? null;

//$author = isset($_SESSION['user_id'])
//    ? $_SESSION['user_id']
//    : null;

if (isset($_SESSION['username'])) {
    $author = $_SESSION['username'];
}
else {
    $author = null;
}


//var_dump($_SESSION);
//die();

if (is_null($author)) {
    echo 'Как ты сюда попал? Ты кто такой? Я тебя не знаю';
    die();
} else {
    echo "I know who you are!" . json_encode($_SESSION, JSON_UNESCAPED_UNICODE);
    die();
}

//if (session_status() === PHP_SESSION_ACTIVE) {
//    // Сессия включена
//    header("Location: index2.php");
//} else {
//    // Сессия не включена
//    echo "Ты не авторизован";
//    header("Location: auth.php");
//}


//if (!isset($_SESSION['log'])) {
//    // Пользователь не авторизован, перенаправьте его на страницу авторизации
//    header('Location: /autho.php');
//    exit();
//}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>PHP</title>
    <link rel="stylesheet" href="css/auth.css">
    <link rel="icon" href="img/fav.ico">
</head>
<body>
<header class="header">
    <h1 class="logo">PHP Blog</h1>

    <form class="search-form">
        <input type="text" name="text" class="search-input" placeholder="Я хочу найти...">
        <input type="submit" name="submit" class="search-button" value="Поиск">
    </form>

    <form action="cabinet.php" target="_blank">
        <div  class="top-right">
            <button href="cabinet.php" class="cabinetButton">Создать статью</button>
        </div>
    </form>

    <form action="#" target="_blank" >
        <div  class="top-buttons">
            <button  href="#" class="cabinetButton">Мой кабинет</button>

        </div>
    </form>

    <form action="#" target="_blank">
        <div  class="left-buttons">
            <button href="#" class="cabinet">Выйти</button>
        </div>
    </form>

</header>

<div class="article">
    <h2>История создания</h2>
    <p>Блог о создании PHP</p>
    <a href="#">Читать далее</a>
</div>

<div class="article">
    <h2>Где применяется PHP?</h2>
    <p>Где же?</p>
    <a href="#">Читать далее</a>
</div>
<div class="article">
    <h2>Почему PHP еще жив?</h2>
    <p>Почему же?</p>
    <a href="#">Читать далее</a>
</div>

<div class="article">
    <h2>Как я страдала над блогом</h2>
    <p>Сейчас расскажу...</p>
    <a href="#">Читать далее</a>
</div>
</body>
</html>
