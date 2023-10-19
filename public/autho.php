<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Авторизация</title>

    <link rel="stylesheet" href="css/new auth.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Авторизация</h1>
    <h4>Авторизуйтесь, чтобы публиковать свои статьи и смотреть публикации других участников</h4>
    <form class="reg" id="authorization-form" action="ajax/login.php" method="post">
        <input type="text" name="login" id="login" placeholder="Логин"><br>
        <input type="password" name="password" id="password" placeholder="Пароль" ><br>

        <div class="alert" id="error"></div>

        <button type="submit" class="auth" id="auth_user"> Авторизоваться </button>
    </form>
</div>
<script>
      $(document).ready(function () {
         $('#authorization-form').submit(function (e) {
             e.preventDefault();
            var login = $('#login').val();
            var password = $('#password').val();

             $.ajax({
             url: 'ajax/login.php',
             type: 'POST',
             data: {
                  'login': login,
                  'password': password
             },
                 dataType: 'json',
                 success: function (data) {
                 if (data.status === 'success') {
                    alert('Авторизация прошла успешно. Перенаправление на страницу блога...');
                     window.location.href = 'index2.php';

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