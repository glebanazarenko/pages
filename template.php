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
                    <li><a href="auth.php?session_user=<?=$session_user?>">Страницы</a></li>
                    <li><a href="create_update.php?reg=<?=$reg?>&session_user=<?=$session_user?>&name=<?=$name?>">Создать</a></li>
                    <?php if(isset($pageid)):?>
                        <li><a href="create_update.php?id=<?=$pageid?>&session_user=<?=$session_user?>&name=<?=$name?>&reg=1">Редактировать</a></li>
                        <li><a href="delete.php?id=<?=$pageid?>&session_user=<?=$session_user?>&name=<?=$name?>&reg=1">Удаление</a></li>
                    <?php endif;?>
                    <li><a href="#">Элемент 5</a></li>
                </ul>
            </div>
            <div id="left">
                <form method="POST">
                    <label></label>
                    <p>Вошли в аккаунт: <?=$name?></p>
                    
                    <label></label>
					<a href="exit.php">Выйти из аккаунта</a>
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