<?php

namespace app\utils;


class Utils
{
    private static $banks = array(
        "001" => "BANCO DE BOGOTA",
        "002" => "BANCO POPULAR",
        "006" => "BANCO SANTANDER",
        "007" => "BANCOLOMBIA",
        "008" => "ABN AMRO BANK",
        "009" => "CITIBANK",
        "010" => "BANISTMO COLOMBIA",
        "012" => "BANCO SUDAMERIS COLOMBIA",
        "013" => "BBVA COLOMBIA",
        "014" => "BANCO HELM SERVICES",
        "019" => "BANCO COLPATRIA",
        "020" => "BANESTADO",
        "022" => "BANCO UNIÓN COLOMBIANO",
        "023" => "BANCO DE OCCIDENTE",
        "024" => "BANCO STANDARD CHARTERED COLOMBIA",
        "029" => "BANCO TEQUENDAMA",
        "030" => "BANCO CAJA SOCIAL",
        "034" => "BANCO SUPERIOR",
        "036" => "BANKBOSTON",
        "037" => "MEGABANCO",
        "039" => "BANCO DAVIVIENDA",
        "041" => "BANCO AGRARIO DE COLOMBIA",
        "048" => "BANCO ALIADAS",
        "050" => "GRANBANCO",
        "052" => "BANCO COMERCIAL AVVILLAS",
        "054" => "BANCO GRANAHORRAR",
        "055" => "BANCO CONAVI",
        "057" => "BANCO COLMENA"
    );

    private static $noApplied = array("13", "14");

    public static function stringifyDate($asoDate) {
        $year = substr($asoDate, 0, 4);
        $month = substr($asoDate, 4, 2);
        $day = substr($asoDate, 6);
        $date = $day . "/" . $month . "/" . $year;
        return $date;
    }

    public static function xlsStringifyDate($date) {
        $d = "2021/01/04";
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        return $day . "/" . $month . "/" . $year;
    }

    public static function xlsNormalizeValue($value) {
        return str_replace([",", "$"], "", substr_replace($value, "", -3));
    }

    public static function xlsGetCedulaAvVillasFromRef($ref) {
        return substr_replace($ref, "", -2);
    }

    public static function xlsCheckReceipt($ref) {
        if (strlen($ref) > 12 && self::getProcessTypeFromRefCell($ref) === "01") {
            $receipt = substr($ref, 18, 8);
            return "Recibo No. $receipt";
        }
        return "";
    }

    public static function getBankByCode($code) {
        return self::$banks[$code];
    }

    public static function getProcessTypeFromRefCell($ref) {
        if (strlen($ref) > 12) {
            return substr($ref, 14, 2);
        }
        return "01";
    }

    public static function canPaymentBeApplied($ref) {
        //return !in_array(self::getProcessTypeFromRefCell($ref), self::$noApplied);
        return self::getProcessTypeFromRefCell($ref) === "01";
    }
}
