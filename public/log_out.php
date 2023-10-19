<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Выйти</title>

    <link rel="stylesheet" href="css/new auth.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Выход</h1>
    <h4>До скорых встреч в нашем блоге!</h4>
    <form class="reg" id="logout-form" action="ajax/log out2.php" method="post">
        <div class="alert" id="error"></div>
        <button type="submit" class="auth" id="logout_user">Выйти</button>
    </form>

</div>
<script>
    $(document).ready(function () {
        $('#logout-form').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: 'ajax/log out2.php',
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'success') {
                        alert('Вы успешно вышли из профиля. Перенаправление на страницу авторизации...');
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