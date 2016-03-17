<?php

require_once ('Factory.php');
require_once (__DIR__ . '/../model/Stats.php');

class StatsFactory extends Factory {

    private $tableName = "compa.stats";
    protected static $instance;

    public function __construct() { }

    public static function getInstance() {
        if (is_null(static::$instance)) {
            static::$instance = new StatsFactory();
        }
        return static::$instance;
    }

    public function getStats() {
        return parent::getAll($this->tableName);
    }

    public function getNbusers() {
        return parent::getListTextFieldValues($this->tableName, "nbusers");
    }

    public function getNbproviders() {
        return parent::getListTextFieldValues($this->tableName, "nbproviders");
    }

    public function getNbsearch() {
        return parent::getListTextFieldValues($this->tableName, "nbsearch");
    }

    public function getNbdevices() {
        return parent::getListTextFieldValues($this->tableName, "nbdevices");
    }

    public function getNblinks() {
        return parent::getListTextFieldValues($this->tableName, "nblinks");
    }

    public function getDateinsert() {
        return parent::getListTextFieldValues($this->tableName, "dateinsert");
    }

    public function createStats($stats) {
        return parent::create($this->tableName, $stats);
    }
    
    public function updateStats($id, $fields) {
        return parent::update($this->tableName, $id, $fields);
    }

    protected function toObject($record) {
        return new Stats(
                $record['id'], $record['nbusers'], $record['nbproviders'], $record['nbsearch'], $record['nbdevices'], $record['nblinks'], $record['dateinsert']
        );
    }
    
    public function deleteStats($id) {
        return parent::delete($this->tableName, $id);
    }

     protected function toSql($stats) {
        if(!is_null($stats) && ($stats instanceof Stats)){
            return "insert into ".$this->tableName."(\"nbusers\",\"nbproviders\",\"nbsearch\",\"nbdevices\",\"nblinks\") values ("
                     . $this->paramToSql($stats->getNbusers()) . "," . $this->paramToSql($stats->getNbproviders()) . ","
                     . $this->paramToSql($stats->getNbsearch()) . "," . $this->paramToSql($stats->getNbdevices()) . ","
                     . $this->paramToSql($stats->getNblinks()).")";
         }
        throw new Exception("the parameter is not an instance of Search ", null, null);
    }

    public function addStats($stats) {
        if ($this->isConnectionSet()) {
            $sql = "insert into ".$this->tableName."(nbusers ,nbproviders,nbsearch,nbdevices,nblinks) 
                      values (" . 
                          $stats->getNbusers() . "," .
                          $stats->getNbproviders() . "," .
                          $stats->getNbsearch() . "," .
                          $stats->getNbdevices() . "," .
                          $stats->getNblinks() . ")";
            $record = $this->connection->executeQuery($sql);

                return $record;
        }
    }
    
    public function findByCriteriaImpl($criterias) {
        $criteriaString = "";
        $nbfields = count($criterias);
        foreach ($criterias as $key => $value) {
            $criteriaString .= $key . " = " . $this->paramToSql($value) . "";
            $nbfields --;
            if ($nbfields > 0) {
                $criteriaString .= " and ";
            }
        }
        return parent::findByCriteria($this->tableName, $criteriaString);
    }
}