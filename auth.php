<?php
require("connectdb.php");

$result = mysqli_query($connect, "SELECT * FROM users WHERE
    login='".$_POST["login"]."' AND
    password='".md5($_POST["password"])."'
");

//echo $_POST["login"];
//echo md5($_POST["password"]);

if(!$result || mysqli_num_rows($result) == 0){
    if(!isset($_GET['session_user'])){
	    echo "Такой пользователь не существует.";
	    exit;
    }
}

if(!isset($_GET['session_user'])){
    $Arr = mysqli_fetch_assoc($result);
    $_SESSION["user"] = $Arr['login'];
    $session_user = $_SESSION["user"];
}
else{
    $session_user = $_GET['session_user'];
}
//require("session.php");
//echo''.$session_user.'';

include("allpages.php");

?>