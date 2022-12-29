<!doctype html>
<html>
    <head>
        <title><?=$title?></title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div id="container">
            <div id="header">
                <ul id="menu">
                    <li><a href="allpages.php">Страницы</a></li>
                    <li><a href="#">Элемент 5</a></li>
                </ul>
            </div>
            <div id="left">
                <form method="POST" action="auth.php">
                    <label>Логин</label>
                    <input type="text" name="login" />
                    <label>Пароль</label>
                    <input type="password" name="password" />
                    <label></label>
                    <button type="submit">Войти</button> <a href="signup.php">Регистрация</a>
                </form>
            </div>
            <div id="right">
                <h1><?=$title?></h1>
                <?=$content;?>
            </div>
            <div id="footer">Копирайт</div>
        </div>
    </body>
</html>