# Блог - сайт на котором можно публиковать статьи.

## При разработке проекта показать:

1. Умение верстать формы на html
2. Умение использовать css селекторы
3. Умение декомпозировать код на процедуры или классы
4. Умение защищаться от sql инъекций и xss аттак
5. Понимание что такое сессии и авторизация и аутентификация. Понимать разницу между авторизацией и аутентификацией и применять её

## Требования: 

1. Без использования php-фреймворков. 
2. Проект должен содержать docker-compose файл, который запустит блог локально. Можно воспользоваться [генератором](https://phpdocker.io/generator)
3. При запуске докер - должна устанавливаться база, в которой будет 5-6 статей примеров 
4. На главной странице выводится список статей
5. При клике на название статьи открывается список всех статей
6. Доступна регистрация. Для регистрации достаточно указать логин и пароль пользователя.
7. Доступна авторизация. Авторизованные пользователи могут войти указав свой логин и пароль
8. Авторизованным пользователям доступна публикация статей 
9. Есть страница поиска статей, где поиск осуществляется через LIKE '%$search%'


## Запустить:

1. cd docker
2. docker-compose up -d --build



