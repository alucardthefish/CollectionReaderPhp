<?php

namespace app\classes;

class OccidenteExcelReader implements IBankExcelReader {

    public function getBankCollection($excelArray)
    {
        $collections = array();
        for ($row=8; $row <= count($excelArray); $row++) { 
            $collection = array(
                "referencia" => $excelArray[$row]["L"],
                "cedula" => substr($excelArray[$row]["L"], 0, 10), 
                "valor" => $excelArray[$row]["J"],
                "tipoPago" => 1,
                "fecha" => $excelArray[$row]["D"],
                "observaciones" => ""
            );
            $collections[] = $collection;
        }

        return $collections;
    }

}