<?php

namespace app\classes;

use app\utils\Utils;

require_once __DIR__ . "/../config/globals.php";

class Asobancaria2001Collector implements ICollector {


    public function getCollectionsArray($collectionFiles)
    {
        // $collectionArrayToApplyPayments = new Recaudos($collectionFiles);
        // $collectionArrayToApplyPayments->getAllData();
        // return "<br>Getting the collections array from Asobancaria2001 txt file";

        $asofile = fopen($collectionFiles, "r") or die ("No se pudo abrir el archivo");
        
        $recaudos_matrix = array();
        $recaudos_counter = 0;

        $firstLine = fgets($asofile);
        $starting_chars = substr($firstLine, 0, 2);

        $fechaRecaudo = $starting_chars == REG_HEADER_FILE_INDEX ? substr($firstLine, 12, 8): "";

        while(!feof($asofile)) {
            $tmp_string = fgets($asofile);
            $starting_chars = substr($tmp_string, 0, 2);
            if($starting_chars == COLLECTION_INDEX) {
                
                $recaudos_counter += 1;
                $referencia = substr($tmp_string, 2, 48);
                $cedula = substr($tmp_string, 2, 46);
                $valor = substr($tmp_string, 50, 12);
                
                $tmp_array = array(
                    "referencia" => (int)$referencia,
                    "cedula" => (int)$cedula, 
                    "valor" => (int)$valor,
                    "tipoPago" => 1,
                    "fecha" => Utils::stringifyDate($fechaRecaudo),
                    "observaciones" => ""
                );
                $recaudos_matrix[] = $tmp_array;
            }
        }
        fclose($asofile);

        return $recaudos_matrix;

    }
}