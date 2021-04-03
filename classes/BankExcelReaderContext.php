<?php

namespace app\classes;

class BankExcelReaderContext {

    private $bankExcelReader;

    public function setBankExcelReader($reader) {
        $this->bankExcelReader = $reader;
    }

    public function getCollections($excelArray) {
        return $this->bankExcelReader->getBankCollection($excelArray);
    }

}