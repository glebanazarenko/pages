<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION["user"] = null;
}
if(isset($_SESSION["user"])){
    $session_user =  $_SESSION["user"];
}else{
    false;
}
?>