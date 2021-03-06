<?php

namespace app\classes;

use app\utils\Utils;

class OccidenteExcelReader implements IBankExcelReader {

    public function getBankCollection($excelArray)
    {
        $collections = array();
        for ($row=8; $row <= count($excelArray); $row++) {

            $ref = $excelArray[$row]["L"];

            if (Utils::canPaymentBeApplied($ref)) {
                
                $collection = array(
                    "referencia" => $ref,
                    "cedula" => (int)substr($excelArray[$row]["L"], 0, 10), 
                    "valor" => (int)Utils::xlsNormalizeValue($excelArray[$row]["J"]),
                    "tipoPago" => 1,
                    "fecha" => Utils::xlsStringifyDate($excelArray[$row]["D"]),
                    "observaciones" => Utils::xlsCheckReceipt($ref)
                );
                $collections[] = $collection;
            }
        }

        return $collections;
    }

}