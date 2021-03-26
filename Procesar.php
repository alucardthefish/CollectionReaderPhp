<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\components\Recaudos;

$filesObtained = $_FILES['myFiles']['tmp_name'];

if ($filesObtained[0] != '') { //count($filesObtained) > 0
    echo "El archivo o los archivos fueron subidos correctamente";
    echo "<br>";
    echo $filesObtained[0];
    echo "<br>";
    echo "<pre>";
    echo var_dump($filesObtained);
    echo "</pre>";
    
    // echo "<br><h5>Leyendo archivo de recaudo subido</h5>";
    // $lector = new Recaudos($filesObtained[0]);
    // $lectura = $lector->loadCollectionFile();
    // echo "<pre>";
    // var_dump($lectura);
    // echo "</pre>";

    echo "<br><h5>Leyendo archivo de recaudo subido</h5>";
    foreach ($filesObtained as $file) {
        $reader = new Recaudos($file);
        $reading = $reader->loadCollectionFile();
        echo "<pre>";
        var_dump($reading);
        echo "</pre>";
    }

} else {
    echo "Llorelo mi fai";
}

