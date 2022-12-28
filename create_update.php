<?php
require("connectdb.php");

if(!empty($_POST)){
    $id = null;
    
    if(!isset($_GET["id"])){
        $result = mysqli_query($connect, 'SELECT u.id from users as u WHERE u.login="'.$_GET['session_user'].'"');
        $profile = mysqli_fetch_assoc($result);


        mysqli_query($connect, "INSERT INTO pages (title, content, id_user) VALUES (
            \"".$_POST["title"]."\", 
            \"".$_POST["content"]."\",
            \"".$profile["id"]."\"
            )"
        );
        
        $id = mysqli_insert_id($connect);
    }
    else{
        mysqli_query($connect, "UPDATE pages SET 
            title = \"".mysqli_escape_string($connect, $_POST["title"])."\", 
            content = \"".mysqli_escape_string($connect, $_POST["content"])."\" 
            WHERE id=".$_GET["id"]
        );
        
        $id = $_GET["id"];
    }

    header("Location: page.php?id=\".$id.\"&reg=\".$reg.\"&session_user=\"$session_user\"");
    exit;
}

$title = "";
$titleValue = "";
$contentValue = "";

if(isset($_GET["id"])){
    $result = mysqli_query($connect, "SELECT * FROM pages WHERE id=".$_GET["id"]);
    
    if(!$result || mysqli_num_rows($result) == 0){
        echo "Такой страницы не существует";
        exit;
    }
    
    $page = mysqli_fetch_assoc($result);
    $titleValue = $page["title"];
    $contentValue = $page["content"];
    $title = "Редактирование страницы";
}
else{
    $title = "Создание новой страницы";
}

$content = "
<form method=\"POST\">
    <div>
        <label>Заголовок</label>
        <input type=\"text\" name=\"title\" value=\"".$titleValue."\" id=\"input-title\">
    </div>
    
    <div>
        <label>Содержимое</label>
        <textarea name=\"content\" id=\"input-content\">".$contentValue."</textarea>
    </div>
    
    <div>
        <button type=\"submit\">Сохранить</button>
    </div>
</form>
";

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