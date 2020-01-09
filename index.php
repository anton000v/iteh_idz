<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>iteh_idz</title>
</head>
<body class="bg-light" style="background-image: url(images/03.png)">
<div class="container p-3">
<div class="header" >
<h1 style="text-align:center;color:white">Библиотека</h1>
</div>
<div class="p-3" style="opacity: 0.6;background-color:#977956">
<form action="" method="post" enctype="multipart/form-data">
    <p align="center"><input type="file" name="filename"></p>
    <p align="center"><input type="submit" value="Загрузить"></p>
</form>
</div>
<div class="bg-dark" style="color:white" align="center">

<?php
$allowExt = array("docx","pdf","txt");

error_reporting(0);
if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
{
	$inext = substr($_FILES["filename"]["name"], 1 + strrpos($_FILES["filename"]["name"], '.'));
	// echo $inext;
        if (in_array($inext, $allowExt)) 
		{
			$_FILES["filename"]["name"] = str_replace(' ', '-', $_FILES["filename"]["name"]);
			move_uploaded_file($_FILES["filename"]["tmp_name"], "library/".$_FILES["filename"]["name"]);
		}
		else
		{
			echo("Ошибочка! Загрузить можно только форматы 'docs','pdf','txt'<br>");
		}		
}else {
    echo("Ошибка загрузки файла!<br>");
}



$dir = "library/";
if (is_dir($dir)) {
	
    $files = scandir($dir);
    array_shift($files);
    for ($i = 0; $i < count($files); $i++) {
        $path = $dir . $files[$i];
        $ext = substr($files[$i], 1 + strrpos($files[$i], '.'));
        if (in_array($ext, $allowExt)) {
			if ($ext == "txt"){
				echo "<p><a href='$path' class='text-success'>$files[$i]</a>&nbsp&nbsp&nbsp-<dfn class='text-muted'>[только просмотр]</dfn></p>";
			}
			else{
				echo "<p><a href='$path' class='text-success'>$files[$i]</a></p>";
			}
        }
    }
} else echo $dir . ' - директория не найдена!<br>';
?>
</div>
</div>
</body>
</html>