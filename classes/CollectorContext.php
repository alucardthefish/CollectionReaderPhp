<?php

namespace app\classes;

class CollectorContext {

    private $collector;

    public function __construct() {
        $this->collector = new Asobancaria2001Collector();
    }

    public function setCollector($collector) {
        $this->collector = $collector;
    }

    public function obtainCollectionData($collectionFiles) {
        $data = $this->collector->getCollectionsArray($collectionFiles);
        return $data;
    }

}