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

    protected function toObject($record) {
        return new Stats(
                $record['id'], $record['nbusers'], $record['nbproviders'], $record['nbsearch'], $record['nbdevices'], $record['nblinks'], $record['dateinsert']
        );
    }

    protected function toSql($device) {
        return "(" .
                $device->getId() . "," .
                $device->getNbusers() . "," .
                $device->getNbproviders() . "," .
                $device->getNbsearch() . "," .
                $device->getNbdevices() . "," .
                $device->getNblinks() . ")";
    }

    public function addStats($stats) {
        if ($this->isConnectionSet()) {
            $sql = "insert into compa.stats(nbusers ,nbproviders,nbsearch,nbdevices,nblinks) 
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

}