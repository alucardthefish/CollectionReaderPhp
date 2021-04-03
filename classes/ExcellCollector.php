<?php

namespace app\classes;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcellCollector implements ICollector {

    public function getCollectionsArray($collectionFiles)
    {

        $excelData = $this->getExcelData($collectionFiles);

        // Check what file is processing
        $checkFileData = $this->checkExcelFile($excelData);
        // Use reader depending on file
        $bankReaderContext = new BankExcelReaderContext();
        if ($checkFileData["banco"] == "Occidente") {
            $bankReaderContext->setBankExcelReader(new OccidenteExcelReader());
        } // Else do same for av villa

        return $bankReaderContext->getCollections($excelData);


    }

    public function getExcelData($excelFile) {
        $inputFileType = IOFactory::identify($excelFile);

        $reader = IOFactory::createReader($inputFileType);

        $spreadsheet = $reader->load($excelFile);

        return $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    }

    public function checkExcelFile($excelArray) {
        $datos = array();
        if ($excelArray[1]["A"] == "BANCO DE OCCIDENTE") {
            $datos["banco"] = "Occidente";
            if (strstr($excelArray[3]["A"], "FONDO ESPECIAL")) {
                $datos["propietario"] = "FEV";
            } else {
                $datos["propietario"] = "SVS";
            }
        } else {
            $datos["banco"] = "Av Villas";
            $datos["propietario"] = "SVS";
        }
        return $datos;
    }
}