<?php
include("connectdb.php");
include("session.php");
if(isset($session_user)){
    $reg = 1;
}
else{
    $reg = 0;
}

$result = mysqli_query($connect, "SELECT * FROM pages WHERE 1");

$title = "Все страницы";
$content = "";

if(!$result || mysqli_num_rows($result) == 0){
	$content = "В базе данных нет страниц.";
}
else{
    $content = "<ul>";
    while($page = mysqli_fetch_assoc($result)){
        $result_2 = mysqli_query($connect, "SELECT u.name, u.id FROM pages as p JOIN users as u on u.id = p.id_user AND p.id = ".$page["id"]);
        $profile = mysqli_fetch_assoc($result_2);

        $content .= '<li>
        <a href=page.php?id='.$page["id"].'&reg='.$reg.'&session_user='.$session_user.'>
        '.$page["title"].'
        </a>
        |
        <a href=profile.php?id='.$profile["id"].'&reg='.$reg.'&session_user='.$session_user.'>
        '.$profile["name"].'
        </a>
        |
        <a href=create_update.php?id='.$page["id"].'&reg='.$reg.'&session_user='.$session_user.'>
        Редактировать
        </a>
        |
        <a href=delete.php?id='.$page["id"].'&reg='.$reg.'&session_user='.$session_user.'>
        Удалить
        </a>
        </li>';   
    }
    $content .= "</ul>";
}
if(isset($session_user)){
    require("template.php");
}
else{
    require("template1.php");
}

?>