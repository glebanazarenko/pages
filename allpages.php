<?php
include("connectdb.php");
include("session.php");
if(isset($session_user)){
    $reg = 1;
}
else{
    $reg = 0;
}

$result_3 = mysqli_query($connect, "SELECT u.name, u.role_id FROM users as u WHERE u.login = \"$session_user\"");
$user_name = mysqli_fetch_assoc($result_3);

$result = mysqli_query($connect, "SELECT * FROM pages WHERE 1");

$title = "Все страницы";
$content = "";

if(!$result || mysqli_num_rows($result) == 0){
	$content = "В базе данных нет страниц.";
}
else{
    $content = "<ul>";
    while($page = mysqli_fetch_assoc($result)){
        $result_2 = mysqli_query($connect, "SELECT u.id, u.login, u.name FROM pages as p JOIN users as u on u.id = p.id_user AND p.id = ".$page["id"]);
        $profile = mysqli_fetch_assoc($result_2);

        if(isset($session_user)){
            $name = $user_name["name"];
        }

        $content .= '<li>
        <a href=page.php?id='.$page["id"].'&name='.$name.'&session_user='.$session_user.'&reg='.$reg.'&profile_name='.$profile["name"].'>
        '.$page["title"].'
        </a>
        |
        <a href=profile.php?id='.$profile["id"].'&name='.$name.'&session_user='.$session_user.'&reg='.$reg.'>
        '.$profile["name"].'
        </a>';
        if(isset($session_user) && ($session_user == $profile["login"] || $user_name["role_id"] == 1)){
            $content .= '
            |
            <a href=create_update.php?id='.$page["id"].'&reg='.$reg.'&session_user='.$session_user.'&name='.$name.'>
            Редактировать
            </a>
            |
            <a href=delete.php?id='.$page["id"].'&reg='.$reg.'&session_user='.$session_user.'&name='.$name.'>
            Удалить
            </a>
            </li>';
        }   
    }
    $content .= "</ul>";
}
if(isset($session_user)){
    $name = $user_name["name"];
    require("template.php");
}
else{
    require("template1.php");
}

?>