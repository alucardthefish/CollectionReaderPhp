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
                    "cedula" => substr($excelArray[$row]["L"], 0, 10), 
                    "valor" => $excelArray[$row]["J"],
                    "tipoPago" => 1,
                    "fecha" => $excelArray[$row]["D"],
                    "observaciones" => ""
                );
                $collections[] = $collection;
            }
        }

        return $collections;
    }

}