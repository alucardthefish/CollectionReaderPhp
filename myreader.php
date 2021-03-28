<?php

require_once __DIR__ . '/vendor/autoload.php';


use app\components\Recaudos;


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
</head>
<body>
	<h2>Cargar recaudo</h2>
	<form action="Procesar.php" method="post" enctype="multipart/form-data">
		<input type="file" name="myFiles[]" id="filez" multiple>
		<input type="submit" value="submit">
	</form>
	<br>
	<h2>Cargar archivo recaudo excel</h2>
	<form action="ProcesarExcel.php" method="post" enctype="multipart/form-data">
		<input type="file" name="excelFiles[]" id="filexlz" multiple>
		<input type="submit" value="submit">
	</form>
</body>
</html>

<?php
/**
 * TODO:
 * 1. Refactor de codigo
 * 2. Identificación del tipo de archivo para asi seleccionar el lector adecuado para extraer datos de recaudos
 * 3. Aplicar un patrón de diseño para tener varios lectores que leen un determinado tipo de archivo asobancaria txt o excel
 */

