<?php

require_once __DIR__ . '/vendor/autoload.php';


use app\components\Recaudos;
use app\utils\Utils;

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<title>Home</title>
</head>
<body class="container mx-auto px-4 my-4">
	<h2 class="text-3xl bold">Cargar Archivos de Recaudo</h2>
	<h3 class="text-2xl bold">para generar archivo de aplicacion de pagos</h3>
	<div class="my-4 mx-2">
		<main>
			<form action="Procesar.php" method="post" enctype="multipart/form-data">
				<input class="block" type="file" name="myFiles[]" id="filez" multiple>
				<input class="block my-4 py-4 rounded-xl px-6 bg-green-600 text-white hover:bg-green-500 focus:outline-none" type="submit" value="Generar">
			</form>
		</main>
	</div>

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

