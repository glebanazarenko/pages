<?php
require("connectdb.php");

$result = mysqli_query($connect, "SELECT * FROM users WHERE
    login='".$_POST["login"]."' AND
    password='".md5($_POST["password"])."'
");

//echo $_POST["login"];
//echo md5($_POST["password"]);

if(!$result || mysqli_num_rows($result) == 0){
	echo "Такой пользователь не существует.";
	exit;
}

$Arr = mysqli_fetch_assoc($result);
$_SESSION["user"] = $Arr['login'];
//require("session.php");
//echo''.$session_user.'';
$session_user = $_SESSION["user"];
include("allpages.php");

?>