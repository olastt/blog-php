<?php
session_start();
//var_dump($_POST);
//var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <title>PHP</title>
    <link rel="stylesheet" href="/css/article.css">
    <link rel="icon" href="/img/fav.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<header class="header">
    <a href="index2.php" class="logo-link">
        <h1 class="logo">PHP Blog</h1>
    </a>

    <form class="search-form">
        <input type="text" name="text" class="search-input" placeholder="Я хочу найти...">
        <input type="submit" name="submit" class="search-button" value="Поиск">
    </form>

    <form action="personal_account.php" target="_blank">
        <div  class="top-right">
            <button href="personal_account.php" class="cabinetButton">Мой кабинет</button>
        </div>
    </form>
</header>

<body>
<div class="container">
    <h1>Добавление статьи</h1>
    <h4>Здесь вы можете добавить свою статью</h4>
    <form style="min-height: 70vh" class="article" id="blog-form" action="/ajax/ajax%20posts.php" method="post">

        <p style="margin-left: -370px">Заголовок</p>
        <input type="text" class="article" name="title" id="title" placeholder="Заголовок статьи"><br>

        <p style="margin-left: -410px">Текст</p>
        <textarea type="text" class="article" name="content" id="content" placeholder="Текст статьи"></textarea>

        <div class="alert" id="error"></div>

        <button type="submit" class="post" id="article_send">Создать</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#blog-form').submit(function (e) {
            e.preventDefault();
            var title = $('#title').val();
            var content = $('#content').val();

            $.ajax({
                url: 'ajax/ajax posts.php',
                type: 'POST',
                data: {
                    'title': title,
                    'content': content
                },
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'success') {
                        alert('Статья успешно добавлена. Обновление страницы...');
                        window.location.href = 'add_posts.php';
                    } else {
                        $('#error').show();
                        $('#error').text('Обратите внимание: ' + data.message);
                    }
                },
                error: function (data) {
                    alert('Произошла ошибка при отправке данных на сервер.');
                }
            });
        });
    });
</script>
</body>
</html