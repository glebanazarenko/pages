<?php
require("connectdb.php");

if(!empty($_POST)){
    $result = mysqli_query($connect, "SELECT * FROM users WHERE login=\"".$_POST['login']."\"");
    //echo mysqli_num_rows($result);
    if(mysqli_num_rows($result) == 0){
        mysqli_query($connect, "INSERT INTO users (name, login, password) VALUES (
            \"".$_POST["name"]."\",
            \"".$_POST["login"]."\",
            \"".md5($_POST["password"])."\" 
            )"
        );
        $_SESSION["user"] = $_POST["login"];
        require("session.php");
    }
    
    //$id = mysqli_insert_id($connect);
    header("Location: allpages.php");
}

$title = "Регистрация";
$content = "
<form method=\"POST\">
    <div>
        <label>ФИО</label>
        <input type=\"text\" name=\"name\">
    </div>
    
    <div>
        <label>Логин</label>
        <input type=\"text\" name=\"login\">
    </div>
    
    <div>
        <label>Пароль</label>
        <input type=\"password\" name=\"password\">
    </div>
    
    <div>
        <button type=\"submit\">Регистрация</button>
    </div>
</form>
";

require("template1.php");

?>