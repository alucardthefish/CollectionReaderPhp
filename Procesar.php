<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\classes\Asobancaria2001Collector;
use app\classes\CollectorContext;
use app\classes\ExcellCollector;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

$filePaths = $_FILES['myFiles']['tmp_name'];
$fileNames = $_FILES['myFiles']['name'];

$numFiles = count($fileNames);


$collectorContext = new CollectorContext();

// Check size of uploaded files
if ($numFiles > 0 && $filePaths[0] != '') {
    $pagosParaAplicar = array();
    // Check type of uploaded files
    for ($i=0; $i < $numFiles; $i++) { 
        $fileExt = strtolower(pathinfo($fileNames[$i], PATHINFO_EXTENSION));
        $isContextOk = true;
        if ($fileExt == 'txt') {
            $collectorContext->setCollector(new Asobancaria2001Collector());
        } elseif ($fileExt == 'xls' || $fileExt == 'xlsx') {
            $collectorContext->setCollector(new ExcellCollector());
        } else {
            echo "<br>File type with extension $fileExt is not supported";
            $isContextOk = false;
        }

        if ($isContextOk) {
            // echo "<pre>";
            // var_dump($collectorContext->obtainCollectionData($filePaths[$i]));
            // echo "</pre>";
            //echo $collectorContext->obtainCollectionData($filePaths[$i]);
            $pagosParaAplicar[] = $collectorContext->obtainCollectionData($filePaths[$i]);
        }
    }
    //echo "<pre>";
    //var_dump($pagosParaAplicar);
    //echo "</pre>";

    // Creating .xls file for apply payments
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hola mundo !');

    $writer = new Xls($spreadsheet);
    $writer->save('holamundo.xls');
    // https://programacion.net/articulo/como_forzar_la_descarga_de_un_fichero_en_php_1935#:~:text=Para%20descargar%20un%20fichero%20en,directorio%20del%20servidor%20en%20PHP.

} else {
    echo "<br>None file selected";
}
