<?php

require_once __DIR__ . '/vendor/autoload.php';


use app\components\Recaudos;

$myfile = fopen("webdictionary.txt", "r") or die("Incapaz de abrir el archivo");
$asofile = fopen("FEVIVIENDA_VIL_20201201.txt", "r") or die ("No se pudo abrir el archivo");
//echo fread($myfile, filesize("webdictionary.txt"));
define("RECAUDO_INDEX", "06");
$counter=0;
$matrix = array();
while(!feof($myfile)) {
	$counter = $counter + 1;
	//echo "linea " . $counter . "\n";
	$tmp = fgets($myfile);
	$matrix[] = str_split($tmp);
}
fclose($myfile);

$recaudos_matrix = array();
$recaudos_counter = 0;
$some_flag = true;
$length_three = 0;
while(!feof($asofile)) {
	$tmp_string = fgets($asofile);
	$starting_chars = substr($tmp_string, 0, 2);
	if($starting_chars == RECAUDO_INDEX) {
		if($some_flag) {
			$length_three = strlen($tmp_string);
			$$some_flag = false;
		}
		//substr(string,start,length)
		$recaudos_counter += 1;
		$referencia = substr($tmp_string, 2, 48);
		$valor = substr($tmp_string, 50, 12); //va hasta 14 pero omitimos los dos ultimos que son los decimales

		$valorDecimales = substr($tmp_string, 62, 2);

		$procPago = substr($tmp_string, 64, 2);
		$medPago = substr($tmp_string, 66, 2);
		$numOperacion = substr($tmp_string, 68, 6);
		$numAutorizacion = substr($tmp_string, 74, 6);
		$codEntFinanc = substr($tmp_string, 80, 3);
		$codSucursal = substr($tmp_string, 83, 4);
		$secuencia = substr($tmp_string, 87, 7);
		$causalDevol = substr($tmp_string, 94, 3);
		$reservado = substr($tmp_string, 97, 65);
		//echo("\nNit: " . $nit . " otra vaina: " . $otra_cosa . " y otra: " . $otra_otra);
		$tmp_array = array(
			"referencia" => $referencia, 
			"valor" => $valor, 
			"procPago" => $procPago,
			"numOperacion" => $numOperacion,
			"numAutorizacion" => $numAutorizacion,
			"codEntFinanc" => $codEntFinanc,
			"codSucursal" => $codSucursal,
			"secuencia" => $secuencia,
			"causalDevol" => $causalDevol,
			"reservado" => $reservado);
		$recaudos_matrix[] = $tmp_array;
	}
}
fclose($asofile);

//print_r($matrix);
//echo("\nCantidad de recaudos: " . $recaudos_counter);
//echo("<br><br>");
//print_r($recaudos_matrix);
// echo '<pre>';
// var_dump($recaudos_matrix);
// echo '</pre>';

$collectionObject = new Recaudos("FEVIVIENDA_VIL_20201201.txt");
$result = $collectionObject->loadCollectionFile();

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

//echo("\n\nEl recaudo Nu. 3:\n");
//print_r($recaudos_matrix[2]);
//echo("\n\nLongitud de cadena de recaudo: " . $length_three);
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
		<input type="text">
		<input type="file" name="myFiles[]" id="filez" multiple>
		<input type="submit" value="submit">
	</form>
	<?php
		$res = 0;
		foreach ($result as $recaudo) {
			echo "REF: " . $recaudo['referencia'] . ", el valor es: " . $recaudo['valor'] . " <br>";
			$res += $recaudo['valor'];
		}
		echo "<h5>Total recaudado: $res</h5>";
		echo "<br>";
		echo "<pre>";
		$header = $collectionObject->getRegHeaderData();
		var_dump($header);
		echo "</pre>";

		echo "<br><br>";
		
		$collectionObject->getAllData();

	?>
</body>
</html>

<?php
/**
 * TODO:
 * 1. Refactor de codigo
 * 2. Identificación del tipo de archivo para asi seleccionar el lector adecuado para extraer datos de recaudos
 * 3. Aplicar un patrón de diseño para tener varios lectores que leen un determinado tipo de archivo asobancaria txt o excel
 */

