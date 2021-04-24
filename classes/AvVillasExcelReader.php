<?php

namespace app\classes;

use app\utils\Utils;

class AvVillasExcelReader implements IBankExcelReader {

    public function getBankCollection($excelArray)
    {
        
        $collections = array();

        for ($row = 20; $row <= count($excelArray); $row+=2) {

            $fecha = $excelArray[$row]["B"];
            $sucursal = $excelArray[$row]["H"];
            $ref = $excelArray[$row]["J"];
            $valor = $excelArray[$row]["W"];

            $collection = array(
                "referencia" => $ref,
                "cedula" => (int)Utils::xlsGetCedulaAvVillasFromRef($ref), 
                "valor" => (int)Utils::xlsNormalizeValue($valor),
                "tipoPago" => 1,
                "fecha" => Utils::xlsStringifyDate($fecha),
                "observaciones" => "Pago realizado en oficina $sucursal"
            );

            $collections[] = $collection;
        }

        return $collections;
    }

}