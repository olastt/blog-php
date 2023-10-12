<?php
session_start();
//var_dump($_POST);
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
    <h1 class="logo">PHP Blog</h1>

    <form class="search-form">
        <input type="text" name="text" class="search-input" placeholder="Я хочу найти...">
        <input type="submit" name="submit" class="search-button" value="Поиск">
    </form>

    <form action="/cabinet.php" target="_blank">
        <div  class="top-right">

            <button href="cabinet.php" class="cabinetButton">Мой кабинет</button>
        </div>
    </form>
</header>

<body>
<div class="container">
    <h1>Добавление статьи</h1>
    <h4>Здесь вы можете добавить свою статью</h4>
    <form style="min-height: 70vh" class="article" id="blog-form" action="/ajax/ajax cabinet.php" method="post">

        <p style="margin-left: -350px">Заголовок</p>
        <input type="text" class="article" name="title" id="title" placeholder="Заголовок статьи"><br>

<!--        <p style="margin-left: -380px">Интро</p>-->
<!--        <textarea type="text" class="article" name="intro" id="intro" placeholder="Интро статьи"></textarea>-->

        <p style="margin-left: -380px">Текст</p>
        <textarea type="text" class="article" name="text" id="text" placeholder="Текст статьи"></textarea>

        <div class="alert" id="error"></div>


        <button type="submit" class="post" id="article_send">Создать</button>

    </form>
</div>

<script>
    $(document).ready(function () {
        $('#blog-form').submit(function (e) {
            e.preventDefault();
            var title = $('#title').val();
            var intro = $('#intro').val();
            var text = $('#text').val();

            $.ajax({
                url: 'ajax/ajax cabinet.php',
                type: 'POST',
                data: {
                    'title': title,
                    'intro': intro,
                    'text': text
                },
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'success') {
                        alert('Статья успешно добавлена. Обновление страницы...');
                        window.location.href = 'cabinet.php';
                    } else {
                        $('#error').show();
                        $('#error').text('Обратите внимание: ' + data.message);
                    }
                },
                error: function (data) {
                    alert('Произошла ошибка при отправке данных на сервер.' + data.message);
                }
            });
        });
    });
</script>
</body>
</html