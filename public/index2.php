<?php
session_start();
$author = $_SESSION['username'] ?? null;
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>PHP Blog</title>
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="css/index2.css">
    <link rel="icon" href="img/fav.ico">
</head>
<body>
<header class="header">
    <h1 class="logo">PHP Blog</h1>
    <form class="search-form" action="ajax/search.php" method="GET">
        <input type="text" name="text" class="search-input" placeholder="Я хочу найти...">
        <input type="submit" name="submit" class="search-button" value="Поиск">
    </form>

    <form action="add_posts.php" target="_blank">
        <div  class="top-right">
            <button href="add posts.php" class="cabinetButton">Создать статью</button>
        </div>
    </form>

    <form action="personal_account.php" target="_blank" >
        <div  class="top-buttons">
            <button  href="personal_account" class="cabinetButton">Мой кабинет</button>

        </div>
    </form>

    <form action="log_out.php" method="post" target="_blank">
        <div class="left-buttons">
            <button href="log out.php" class="cabinet">Выйти</button>
        </div>
    </form>
</header>
<div class="article">
    <h2>История создания</h2>
    <p>Блог о создании PHP</p>
    <a href="ajax/posts_default.php?id=1">Читать далее</a>
</div>

<div class="article">
    <h2>Где применяется PHP?</h2>
    <p>Где же?</p>
    <a href="ajax/posts_default.php?id=3">Читать далее</a>
</div>

<div class="article">
    <h2>Почему PHP еще жив?</h2>
    <p>Почему же?</p>
    <a href="ajax/posts_default.php?id=5">Читать далее</a>
</div>

<div class="article">
    <h2>Как я страдала над блогом</h2>
    <p>Сейчас расскажу...</p>
    <a href="ajax/posts_default.php?id=6">Читать далее</a>
</div>
</body>
</html>
