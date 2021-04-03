<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\classes\Asobancaria2001Collector;
use app\classes\CollectorContext;
use app\classes\ExcellCollector;

$filePaths = $_FILES['myFiles']['tmp_name'];
$fileNames = $_FILES['myFiles']['name'];

$numFiles = count($fileNames);


$collectorContext = new CollectorContext();

// Check size of uploaded files
if ($numFiles > 0 && $filePaths[0] != '') {
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
            echo "<pre>";
            var_dump($collectorContext->obtainCollectionData($filePaths[$i]));
            echo "</pre>";
            //echo $collectorContext->obtainCollectionData($filePaths[$i]);
        }
    }
} else {
    echo "<br>None file selected";
}
