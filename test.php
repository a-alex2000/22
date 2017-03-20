<?php
if ( isset ( $_GET['test'] ) ) {
	$filename = "tests/".$_GET['test'];
    if ( file_exists( $filename ) == false ) {
        echo "Такого файла нет. Ошибка 404.";
        die();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<title>Таблица из json файла в html</title>
</head>
<body>

<?php
if ( isset( $_GET['test'] ) ) {
	echo "<table>";
    echo "<form method=\"POST\" action=\"test.php\">";
    echo "<input type=\"hidden\" name=\"test\" value=".$_GET['test'].">";
    $filename = "tests/".$_GET['test'];
    $text_json = file_get_contents( $filename );
    $json_array = json_decode( $text_json, true); // получаем массив
    echo "<h1>".$json_array[0]['question']."</h1>";
    $colorFlag = "true";
    foreach ($json_array[0]['answer'] as $key => $value) {
        if ( $colorFlag == true ) $color = "white";else $color = "#e3e3b6";
        echo "<tr bgcolor = \"".$color."\">";
        echo "<td><input type=\"radio\" name=\"answer\" value=\"".$value."\">".$value."</td>";
        echo "</tr>";
        $colorFlag = !$colorFlag;
    }
echo <<<PHP
<tr><td><input type="submit" name="correct" value="Отправить ответ!"><td><tr>
</form>
</table>
PHP;
}

if ( isset( $_POST['correct'] ) && isset( $_POST['answer'] ) ) {
	echo "<table>";
    echo "<form method=\"POST\" action=\"test.php\">";
    $filename = "tests/".$_POST['test'];
    $text_json = file_get_contents( $filename );
    $json_array = json_decode( $text_json, true); // получаем массив
    echo "<h1>".$json_array[0]['question']."</h1>";
    $colorFlag = "true";
    foreach ($json_array[0]['answer'] as $key => $value) {
        if ( $colorFlag == true ) $color = "white";else $color = "#e3e3b6";
        if ( $_POST['answer'] == $value ) $color="red";
        if ( $value == $json_array[0]['correct'] ) $color="green";
        echo "<tr bgcolor = \"".$color."\">";
        echo "<td>".$value."</td>";
        echo "</tr>";
        $colorFlag = !$colorFlag;
    }
echo <<<PHP
</form>
</table>
<pre>
<div>
PHP;
if ( $_POST['answer'] == $json_array[0]['correct'] ) echo "Вы оветили правильно.";
    else echo "Вы ответили не правильно.";
} else echo "<p>Надо выбрать один из вариантов. Выберите тест.</p>";
echo "</div></pre>";
?>
<br>
<p>
<a href="list.php">Список тестов.</a><br><br>
<a href="admin.php">Загрузить файл с тестом.</a>
</p>
<div>
Copyright.Андрей Мурашов.
</div>
</body>
</html>