<?php

use app\classes\Recaudos;

require_once __DIR__ . '/vendor/autoload.php';
//require_once __DIR__ . '/Classes/PHPExcel.php';


$filesObtained = $_FILES['excelFiles']['tmp_name'];

if ($filesObtained[0] != '') { //count($filesObtained) > 0
    echo "El archivo o los archivos fueron subidos correctamente";

    echo "<br><h5>Leyendo archivo de recaudo subido</h5>";
    

    // $reader = PHPExcel_IOFactory::createReaderForFile($filesObtained[0]);
    // $excel_obj = $reader->load($filesObtained[0]);

    // echo "<pre>";
    // var_dump($filesObtained);
    // echo "</pre>";

    foreach ($filesObtained as $file) {
        $recaudo = new Recaudos($file);
        $recaudo->getAllData();
    }
    
    

} else {
    echo "Ningun archivo fue seleccionado";
}