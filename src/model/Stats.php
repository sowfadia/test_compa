<?php

/**
 * Description of Stats
 *
 * @author sowf
 */
class Stats {
    private $idStats;
    
    function __construct($idStats) {
        $this->idStats = $idStats;
    }
    
    function getIdStats() {
        return $this->idStats;
    }
}
