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
	<div class="my-4 mx-2">
		<main>
			<form action="Procesar.php" method="post" enctype="multipart/form-data">
				<input class="inline-block px-16 py-16 bg-green-700 bold text-white" type="file" name="myFiles[]" id="filez" multiple>
				<!-- <label class="relative block px-16 py-16 bg-green-700 bold text-white" for="filez" id="filezLabel">
					Selecciona o Arrastra archivos aqui
				</label> -->
				<input type="submit" value="submit">
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

