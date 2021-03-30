<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\classes\Recaudos;

$filesObtained = $_FILES['myFiles']['tmp_name'];

if ($filesObtained[0] != '') { //count($filesObtained) > 0
    echo "El archivo o los archivos fueron subidos correctamente";

    echo "<br><h5>Leyendo archivo de recaudo subido</h5>";
    foreach ($filesObtained as $file) {
        $reader = new Recaudos($file);
        $reader->getAllData();
    }

} else {
    echo "Ningun archivo fue seleccionado";
}