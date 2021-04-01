<?php

namespace app\classes;

class Asobancaria2001Collector implements ICollector {

    public $collectionDate = '230';

    public function getCollectionsArray($collectionFiles)
    {
        $collectionArrayToApplyPayments = new Recaudos($collectionFiles);
        $collectionArrayToApplyPayments->getAllData();
        return "<br>Getting the collections array from Asobancaria2001 txt file";
    }
}