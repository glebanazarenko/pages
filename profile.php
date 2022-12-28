<?php
require("connectdb.php");

if(!isset($_GET['id'])){
	echo "Укажите id пользователя.";
	exit;
}

$result = mysqli_query($connect, "SELECT p.title, u.name, p.id FROM users as u JOIN pages as p ON p.id_user = u.id AND u.id =".$_GET['id']);

if(!$result || mysqli_num_rows($result) == 0){
	echo "В базе данных нет страниц автора с таким id.";
	exit;
}

$profile = mysqli_fetch_assoc($result);

$title = "Страницы пользователя ".$profile["name"]."";
$content = "";
$content = "<ul>";
do{
    
        $content .= "<li>
        <a href=\"page.php?id=".$profile["id"]."\">
        ".$profile["title"]."
        </a>
        |
        <a href=\"create_update.php?id=".$profile["id"]."\">
        Редактировать
        </a>
        |
        <a href=\"delete.php?id=".$profile["id"]."\">
        Удалить
        </a>
        </li>";   
}while($profile = mysqli_fetch_assoc($result));
$content .= "</ul>";

require("template.php");
?>