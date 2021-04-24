<?php

require_once __DIR__ . '/vendor/autoload.php';


use app\components\Recaudos;
use app\utils\Utils;

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
</body>
</html>

<?php
/**
 * TODO:
 * 1. Refactor de codigo [hecho]
 * 2. Identificación del tipo de archivo para asi seleccionar el lector adecuado para extraer datos de recaudos [hecho]
 * 3. Aplicar un patrón de diseño para tener varios lectores que leen un determinado tipo de archivo asobancaria txt o excel [hecho]
 * 4. Consolidar metodo que agrupe todos los datos extraidos de los diferentes archivos y retorne un arreglo 
 * 5. Metodo que transforme el arreglo a un archivo de excel formato xls
 */

