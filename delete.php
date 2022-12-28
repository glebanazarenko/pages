<?php
require("connectdb.php");

if(!isset($_GET["id"])){
    echo "Не указан идентификатор страницы.";
    exit;
}
else{
    mysqli_query($connect, "DELETE FROM pages WHERE id=".$_GET["id"]);
    header("Location: allpages.php");
}

//require("template.php");
?>