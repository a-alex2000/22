<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel= "stylesheet" type = "text/css" href = "style/style.css">
	<title>Загрузка теста.</title>
</head>
<body>
<h1>Выберите файл для загрузки</h1>
<div>
<form enctype = "multipart/form-data" method = "POST" action = "admin.php">
    <input type= "hidden" name="MAX_FILE_SIZE" value="30000">
    <input name= "userfile" type="file"><br>
    <input type= "submit" name="uploadfile" value = "Загрузить">
</form>
</div>
<?php

if ( isset ( $_POST['uploadfile'] )  ) {
    $uploaddir = __DIR__."/tests/";
    $uploadfile = $uploaddir.basename( $_FILES['userfile']['name'] );
    if ( move_uploaded_file( $_FILES['userfile']['tmp_name'], $uploadfile ) ) {
        print "<p>Файл успешно закачен на сервер.</p>";
    } else {
        print "<p>!!!Файл Не закачен на сервер!!!</p>";
    }
}
?>
<br>
<p>
<a href="list.php">Список тестов.</a><br>
</p>
<div>
Copyright.Андрей Мурашов.
</div>
</body>
</html>