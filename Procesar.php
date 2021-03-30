<?php
require_once __DIR__ . '/vendor/autoload.php';

use app\classes\Asobancaria2001Collector;
use app\classes\CollectorContext;
use app\classes\ExcellCollector;

$filePaths = $_FILES['myFiles']['tmp_name'];
$fileTypes = $_FILES['myFiles']['type'];
$fileNames = $_FILES['myFiles']['name'];

$numFiles = count($_FILES['myFiles']['name']);


$collectorContext = new CollectorContext();

// Check size of uploaded files
if (count($filePaths) > 0 && $filePaths[0] != '') {
    // Check type of uploaded files
    for ($i=0; $i < $numFiles; $i++) { 
        $fileExt = pathinfo($fileNames[$i], PATHINFO_EXTENSION);
        $isContextOk = true;
        if ($fileExt == 'txt' || $fileExt == 'TXT') {
            $collectorContext->setCollector(new Asobancaria2001Collector());
        } elseif ($fileExt == 'xls' || $fileExt == 'xlsx') {
            $collectorContext->setCollector(new ExcellCollector());
        } else {
            echo "<br>File type is not supported";
            $isContextOk = false;
        }

        if ($isContextOk) {
            echo $collectorContext->obtainCollectionData($filePaths[$i]);
        }
    }
} else {
    echo "<br>None file selected";
}
