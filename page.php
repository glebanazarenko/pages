<?php
require("connectdb.php");
include("session.php");

if(!isset($_GET['id'])){
	echo "Укажите id страницы.";
	exit;
}

$result = mysqli_query($connect, "SELECT * FROM pages WHERE id=".$_GET['id']);

if(!$result || mysqli_num_rows($result) == 0){
	echo "В базе данных нет страницы с таким id.";
	echo $_GET['id'];
	exit;
}

$page = mysqli_fetch_assoc($result);
$title = $page["title"];
$content = $page["content"];
$pageid = $page["id"];

if(isset($_GET['reg'])){
	$reg = $_GET['reg'];
	$session_user = $_GET['session_user'];
	$name = $_GET['name'];
}else{
	$reg = 0;
}

$result_3 = mysqli_query($connect, "SELECT u.name, u.role_id FROM users as u WHERE u.login = \"$session_user\"");
$user_name = mysqli_fetch_assoc($result_3);

$result_4 = mysqli_query($connect, "SELECT u.login FROM users as u JOIN pages as p ON p.id_user = u.id AND p.id =".$pageid);
$user_login = mysqli_fetch_assoc($result_4);


if($reg){
	if($user_login["login"] == $_GET["session_user"] || $user_name["role_id"] == 1){
		require("template.php");
	}else{
		require("template2.php");
	}
}
else{
	require("template1.php");
}
?>