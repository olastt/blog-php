<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>PHP</title>
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="icon" href="../img/fav.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<header class="header">
    <h1 style="font-weight: 700; color:black" class="logo">PHP Blog</h1>
    <form class="search-form">
        <input type="text" name="text" class="search-input" placeholder="Я хочу найти...">
        <input type="submit" name="submit" class="search-button" value="Поиск">
    </form>
    <form action="../add_posts.php" target="_blank">
        <div class="top-right">
            <button class="cabinetButton">Создать статью</button>
        </div>
    </form>
    <form action="../personal_account.php" target="_blank">
        <div class="top-buttons">
            <button class="cabinetButton">Мой кабинет</button>
        </div>
    </form>
    <form action="../log_out.php" method="post" target="_blank">
        <div class="left-buttons">
            <button class="cabinet">Выйти</button>
        </div>
    </form>
</header>

<?php
$id = $_GET["id"]; // получение ID поста из параметра URL

$servername = "mysql"; // адрес сервера базы данных
$username = "root"; // имя пользователя базы данных
$password = ""; // пароль базы данных
$dbname = "testing"; // имя базы данных

// создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "SELECT title, content FROM posts_default WHERE id = $id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $title = $row["title"];
    $content = $row["content"];
    ?>
    <div class="card">
        <div class="card-header"><?= $title ?></div>
        <div class="card-body">
            <?php
            $post = ['title' => $title, 'content' => $content];
            $content = $post['content'];
            $paragraphs = explode("\n", $content); // разделяю текст на абзацы по символу новой строки
            foreach ($paragraphs as $paragraph) {
                echo '<p class="card-text">' . $paragraph . '</p>';
            }
            ?>
        </div>
    </div>
    <?php
}
$conn->close();
?>
</body>
</html>
