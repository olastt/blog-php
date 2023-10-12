<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/new reg.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
<div class="container">
    <h1>Регистрация</h1>
    <h4>Зарегистрируйтесь, чтобы публиковать свои статьи и смотреть публикации других участников</h4>
    <h4>Запомните свой логин и пароль для дальнейшей авторизации</h4>
    <form class="reg" id="registration-form" action="ajax/reg.php" method="post">
        <p style="margin-left: 60px">Имя</p>
        <input type="text" name="username" id="username" placeholder="Имя пользователя"><br>
        <p style="margin-left: 80px">Пароль</p>
        <input type="password" name="password" id="password" placeholder="Пароль"><br>
        <p style="margin-left: 70px">Логин</p>
        <input type="text" name="login" id="login" placeholder="Логин"><br>
        <p style="margin-left: 80px">Почта</p>
        <input type="text" name="email" id="email" placeholder="Email"><br>

        <div class="alert" id="error"></div>

        <button type="submit" class="register" id="reg_user">Зарегистрироваться</button>
    </form>
</div>

<script>

    // async function postData(url = "", data = {}) {
    //     // Default options are marked with *
    //     const response = await fetch(url, {
    //         method: "POST", // *GET, POST, PUT, DELETE, etc.
    //         mode: "cors", // no-cors, *cors, same-origin
    //         cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    //         credentials: "same-origin", // include, *same-origin, omit
    //         headers: {
    //             "Content-Type": "application/json",
    //             // 'Content-Type': 'application/x-www-form-urlencoded',
    //         },
    //         redirect: "follow", // manual, *follow, error
    //         referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    //         body: JSON.stringify(data), // body data type must match "Content-Type" header
    //     });
    //
    //     return response.json(); // parses JSON response into native JavaScript objects
    // }


    $(document).ready(function () {
        $('#registration-form').submit(function (e) {
            e.preventDefault();
            var name = $('#username').val();
            var pass = $('#password').val();
            var login = $('#login').val();
            var email = $('#email').val();

            // postData("ajax/reg.php", {
            //         'username': name,
            //         'password': pass,
            //         'login': login,
            //         'email': email
            //     }).then((data) => {
            //     console.log(data); // JSON data parsed by `data.json()` call
            // });



            $.ajax({
                url: 'ajax/reg.php',
                type: 'POST',
                data: {
                    'username': name,
                    'password': pass,
                    'login': login,
                    'email': email
                },
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'success') {
                        alert('Регистрация прошла успешно. Перенаправление на страницу авторизации...');
                        window.location.href = 'autho.php';
                    } else {
                        $('#error').show();
                        $('#error').text('Обратите внимание: ' + data.message);
                    }
                },
                error: function () {
                    alert('Произошла ошибка при отправке данных на сервер.');
                }
            });
        });
    });
</script>
</body>

</html>
