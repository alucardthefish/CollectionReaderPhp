<?php

namespace app\components;

require_once __DIR__ . '/../config/globals.php';

class Recaudos
{
    public $file;
    public function __construct($file) {
        $this->file = $file;
    }

    public function loadCollectionFile() {
        /**
         * Function that loads all the collections from a file in Asobancaria reference
         * @return array with all the data
         */

        $asofile = fopen($this->file, "r") or die ("No se pudo abrir el archivo");
        
        $recaudos_matrix = array();
        $recaudos_counter = 0;
        $some_flag = true;
        $length_three = 0;
        while(!feof($asofile)) {
            $tmp_string = fgets($asofile);
            $starting_chars = substr($tmp_string, 0, 2);
            if($starting_chars == COLLECTION_INDEX) {
                if($some_flag) {
                    $length_three = strlen($tmp_string);
                    $$some_flag = false;
                }
                
                $recaudos_counter += 1;
                $referencia = substr($tmp_string, 2, 48);
                $valor = substr($tmp_string, 50, 12); //va hasta 14 pero omitimos los dos ultimos que son los decimales

                $valorDecimales = substr($tmp_string, 62, 2);

                $procPago = substr($tmp_string, 64, 2);
                $medPago = substr($tmp_string, 66, 2);
                $numOperacion = substr($tmp_string, 68, 6);
                $numAutorizacion = substr($tmp_string, 74, 6);
                $codEntFinanc = substr($tmp_string, 80, 3);
                $codSucursal = substr($tmp_string, 83, 4);
                $secuencia = substr($tmp_string, 87, 7);
                $causalDevol = substr($tmp_string, 94, 3);
                $reservado = substr($tmp_string, 97, 65);
                
                $tmp_array = array(
                    "referencia" => (int)$referencia, 
                    "valor" => (int)$valor,
                    "valordec" => $valorDecimales, 
                    "procPago" => $procPago,
                    "medPago" => $medPago,
                    "numOperacion" => $numOperacion,
                    "numAutorizacion" => $numAutorizacion,
                    "codEntFinanc" => $codEntFinanc,
                    "codSucursal" => $codSucursal,
                    "secuencia" => $secuencia,
                    "causalDevol" => $causalDevol,
                    "reservado" => $reservado);
                $recaudos_matrix[] = $tmp_array;
            }
        }
        fclose($asofile);

        return $recaudos_matrix;

    } //End loadCollectionFile

    
    public function getRegHeaderData()
    {
        $asofile = fopen($this->file, "r") or die ("No se pudo abrir el archivo");

        $firstLine = fgets($asofile);
        $starting_chars = substr($firstLine, 0, 2);

        $regHeaderData = array();

        if ($starting_chars == REG_HEADER_FILE_INDEX) {
            $regType = substr($firstLine, 0, 2);
            $nitEmpresa = substr($firstLine, 2, 10);
            $fechaRecaudo = substr($firstLine, 12, 8);
            $codEntidad = substr($firstLine, 20, 3);
            $numCuenta = substr($firstLine, 23, 17);
            $fechaArchivo = substr($firstLine, 40, 8);
            $horaGrabArchivo = substr($firstLine, 48, 4);
            $modificadoArchivo = substr($firstLine, 52, 1);
            $tipoCuenta = substr($firstLine, 53, 2);
            $reservado = substr($firstLine, 55, 107);

            $regHeaderData = array(
                "regType" => $regType,
                "nitEmpresa" => $nitEmpresa,
                "fechaRecaudo" => $fechaRecaudo,
                "codEntidad" => $codEntidad,
                "numCuenta" => $numCuenta,
                "fechaArchivo" => $fechaArchivo,
                "horaGrabArchivo" => $horaGrabArchivo,
                "modificadoArchivo" => $modificadoArchivo,
                "tipoCuenta" => $tipoCuenta,
                "reservado" => $reservado
            );
        }

        fclose($asofile);

        return $regHeaderData;
    } // End getRegHeaderData


    public function getAllData()
    {

        $fechaRecaudo = $this->getRegHeaderData()['fechaRecaudo'];
        $recaudos = $this->loadCollectionFile();
        $recaudosCounter = 1;
        echo "No.   |   Referencia  |   TipoPago    |   Valor   |   Fecha   |<br>";

        foreach ($recaudos as $recaudo) {
            
            echo "$recaudosCounter " . $recaudo['referencia'] . " - 1 - " . $recaudo['valor'] . " - " . $fechaRecaudo . "<br>";
            $recaudosCounter += 1;
        }
    }


}
