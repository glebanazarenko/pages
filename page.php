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
	exit;
}

$page = mysqli_fetch_assoc($result);
$title = $page["title"];
$content = $page["content"];
$pageid = $page["id"];

if(isset($_GET['reg'])){
	$reg = $_GET['reg'];
	$session_user = $_GET['session_user'];
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