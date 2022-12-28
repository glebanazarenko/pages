<?php
require("connectdb.php");

if(!isset($_GET["id"])){
    echo "Не указан идентификатор страницы.";
    exit;
}
else{
    mysqli_query($connect, "DELETE FROM pages WHERE id=".$_GET["id"]);

    if(isset($_GET['reg'])){
        $reg = $_GET['reg'];
        $session_user = $_GET['session_user'];
    }else{
        $reg = 0;
    }
    if($reg){
        header("Location: auth.php?session_user=$session_user");
    }
    else{
        header("Location: allpages.php");
    }
}

//require("template.php");
?>