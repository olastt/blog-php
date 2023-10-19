<?php
session_start();
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>PHP</title>

    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="css/personal.css">

    <link rel="icon" href="img/fav.ico">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<header class="header">
    <a href="index2.php" class="logo-link">
        <h1 class="logo">PHP Blog</h1>
    </a>


    <form class="search-form">
        <input type="text" name="text" class="search-input" placeholder="Я хочу найти...">
        <input type="submit" name="submit" class="search-button" value="Поиск">
    </form>

    <form action="add_posts.php" target="_blank">
        <div  class="top-right">
            <button href="add posts.php" class="cabinetButton">Создать статью</button>
        </div>
    </form>

    <form action="log_out.php" method="post" target="_blank">
        <div class="left-buttons">
            <button href="log out.php" class="cabinet">Выйти</button>
        </div>
    </form>

</header>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
            $user_id = $_SESSION['user_id'];
            // подключение к базе данных и проверка аутентификации пользователя
            $pdo = require_once __DIR__ . '/database/database.php';

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT login FROM users WHERE id = :user_id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->execute();
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user !== false) {
                // Выводим логин пользователя и приветственное сообщение
                echo '<h2 class="text-center">Здравствуйте, ' . $user['login'] . ', здесь собраны Ваши статьи</h2>';
            }

            // выполняю SQL-запрос для получения постов пользователя
            $sql = "SELECT * FROM posts WHERE author_id = :user_id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->execute();
            $posts = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($posts as $post) {
                ?>
                <div class="card">
                    <div class="card-header"><?= $post['title'] ?></div>
                    <div class="card-body"><?= $post['content'] ?></div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

</div>
</body>
</html>