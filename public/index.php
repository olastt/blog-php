<!DOCTYPE html>
<html lang="ru">
<head>
    <title>PHP</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/fav.ico">
</head>
<body>
<header class="header">
    <h1 class="logo">PHP Blog</h1>

    <form class="search-form">
        <input type="text" name="text" class="search-input" placeholder="Я хочу найти...">
        <input type="submit" name="submit" class="search-button" value="Поиск">
    </form>

    <form action="register.php" target="_blank">
    <div  class="top-right">
        <button href="register.php" class="registrationButton">Регистрация</button>
        <button class="authorizationButton">Авторизация</button>
    </div>
    </form>
    <form action="autho.php" target="_blank">
        <div  class="top-right">
            <button class="authorizationButton">Авторизация</button>
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