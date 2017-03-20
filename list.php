<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/style.css">
	<title>Список тестов.</title>
</head>
<body>
<h1>Список тестов.</h1>
<p>
<?php
$dir = "./tests/";
$files = scandir ( $dir );
#var_dump( $files );
$y = count ( $files );
for ( $x = 2; $x < $y; $x ++){
	#echo $files[$x]."<br>";
	$filename = $dir.$files[$x];
    $text_json = file_get_contents( $filename );
    $json_array = json_decode( $text_json, true); // получаем массив
    echo "<a href=\"test.php?test=$files[$x]\">".$json_array[0]['question']."</a><br>";
    #echo $json_array[0]['question']."<br>";
}
?>
<br>
<a href="admin.php">Загрузить файл с тестом.</a>
</p>
<div>
Copyright.Андрей Мурашов.
</div>
</body>
</html>