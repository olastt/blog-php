<?php
session_start();
//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>PHP</title>
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/search.css">
    <link rel="icon" href="../img/fav.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
    <h1 style="font-weight: 700; color:black" class="logo" >PHP Blog</h1>

    <form class="search-form" action="" method="GET">
            <input type="text" name="text" class="search-input" placeholder="Я хочу найти..." value="<?php echo $_GET['text'] ?? ''; ?>">
            <input type="submit" name="submit" class="search-button" value="Поиск">
    </form>

    <form action="../add_posts.php" target="_blank">
        <div class="top-right">
            <button href="add posts.php" class="cabinetButton">Создать статью</button>
        </div>
    </form>

    <form action="../personal_account.php" target="_blank" >
        <div class="top-buttons">
            <button  href="personal account" class="cabinetButton">Мой кабинет</button>
        </div>
    </form>

    <form action="../log_out.php" method="post" target="_blank">
        <div class="left-buttons">
            <button href="log out.php" class="cabinet">Выйти</button>
        </div>
    </form>
</header>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <?php
            $servername = "mysql"; // адрес сервера базы данных
            $username = "root"; // имя пользователя базы данных
            $password = "123456"; // пароль базы данных
            $dbname = "testing"; // имя базы данных

            // Создание подключения к базе данных
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Проверка подключения
            if ($conn->connect_error) {
                die("Ошибка подключения: " . $conn->connect_error);
            }

            // Получение поискового запроса из формы
            $search = $_GET['text'];

            if (empty($search)) {
                echo '<p style="text-align: center;  font-family: Arial, sans-serif;">Пустой запрос</p>' ;
            }

            // Поиск статей в базе данных из двух таблиц
            $sql = "SELECT title, content FROM posts WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
            $sql .= " UNION ALL ";
            $sql .= "SELECT title, content FROM posts_default WHERE title LIKE '%$search%' OR content LIKE '%$search%'";

            $result = $conn->query($sql);
            if ($result === false) {
                die("Ошибка выполнения SQL-запроса: " . $conn->error);
            }

            // Обработка результатов
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="card mt-3">
                        <div class="card-header "><?= $row['title'] ?></div>
                        <div class="card-body">
                            <?php
                            $content = $row['content'];
                            $paragraphs = explode("\n", $content); // разделяю текст на абзацы по символу новой строки
                            foreach ($paragraphs as $paragraph) {
                                echo '<p class="card-text" style="font-size: 16px; margin-bottom: 10px;">' . $paragraph . '</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p style="text-align: center;  font-family: Arial, sans-serif;">По вашему запросу ничего не найдено.</p>';
            }


            $conn->close();
            ?>
</body>
</html>
