<?php
require("connectdb.php");

if(!isset($_GET['id'])){
	echo "Укажите id пользователя.";
	exit;
}

if(isset($_GET['session_user'])){
        $result_3 = mysqli_query($connect, 'SELECT u.role_id FROM users as u WHERE u.login = "'.$_GET['session_user'].'"');
        $user_name = mysqli_fetch_assoc($result_3);
}

echo $user_name["role_id"];

$result = mysqli_query($connect, "SELECT p.title, u.name, p.id, u.login FROM users as u JOIN pages as p ON p.id_user = u.id AND u.id =".$_GET['id']);

if(!$result || mysqli_num_rows($result) == 0){
	echo "В базе данных нет страниц автора с таким id.";
	exit;
}

$profile = mysqli_fetch_assoc($result);

$title = "Страницы пользователя ".$profile["name"]."";
$content = "";
$content = "<ul>";

do{
        $content .= '<li>
        <a href=page.php?id='.$profile["id"].'&reg='.$_GET['reg'].'&session_user='.$_GET['session_user'].'&name='.$_GET['name'].'&profile_name='.$profile["name"].'>
        '.$profile["title"].'
        </a>';
        if(isset($_GET['session_user']) && ($_GET['session_user'] == $profile["login"] || $user_name["role_id"] == 1)){
                $content .= '
                |
                <a href=create_update.php?id='.$profile["id"].'&reg='.$_GET['reg'].'&session_user='.$_GET['session_user'].'&name='.$_GET['name'].'>
                Редактировать
                </a>
                |
                <a href=delete.php?id='.$profile["id"].'&reg='.$_GET['reg'].'&session_user='.$_GET['session_user'].'&name='.$_GET['name'].'>
                Удалить
                </a>
                </li>';   
        }


}while($profile = mysqli_fetch_assoc($result));
$content .= "</ul>";


if(isset($_GET['reg'])){
	$reg = $_GET['reg'];
	$session_user = $_GET['session_user'];
        $name = $_GET['name'];
}else{
	$reg = 0;
}
if($reg){
	require("template.php");
}
else{
	require("template1.php");
}
?>