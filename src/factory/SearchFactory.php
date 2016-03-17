<?php

require_once ('Factory.php');
require_once (__DIR__ . '/../model/Device.php');

class SearchFactory extends Factory {

    private $tableName = "compa.search";

    /**
     * The single instance of the factory
     */
    protected static $instance;

    /**
     * constructor 
     */
    public function __construct() {
        
    }

    /**
     * gets the unique instance of this factory
     * @return SearchFactory, the Factory's singleton
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new SearchFactory();
        }
        return self::$instance;
    }

    public function getSearches() {
        return parent::getAll($this->tableName);
    }

    public function findSearchById($id) {
        return parent::findById($this->tableName, $id);
    }

    public function findSearchesByUser($userId) {
        $sql = "select * from device where user=" . $userId;
        $record = $this->connection->executeQuery($sql);
        if ($record) {
            return $this->createDevice($record[0]);
        }
        return null;
    }

    public function deleteSearch($id) {
        return parent::delete($this->tableName, $id);
    }

    public function updateSearch($id, $fields) {
        return parent::update($this->tableName, $id, $fields);
    }

    public function createSearch(Search $search) {
        return parent::create($search);
    }

    protected function toObject($record) {
        return new Search(
                $record['id'], $record['iduser'], $record['brand'], $record['pricemin'], $record['pricemax'], $record['warranty'], $record['waterproof'], $record['screendefinition'], $record['screenresolutionmin'], $record['screenresolutionmax'], $record['screensizemin'], $record['screensizemax'], $record['screenpanel'], $record['cpumodel'], $record['cpufrequencymin'], $record['cpufrequencymax'], $record['cpucoremin'], $record['cpucoremax'], $record['rammin'], $record['rammax'], $record['cameraresolutionmin'], $record['cameraresolutionmax'], $record['frontcameraresolutionmin'], $record['frontcameraresolutionmax'], $record['flash'], $record['sizeheighmin'], $record['sizeheighmax'], $record['sizewidthmin'], $record['sizewidthmax'], $record['sizethicknessmin'], $record['sizethicknessmax'], $record['weightmin'], $record['weightmax'], $record['batterycapacitymin'], $record['batterycapacitymax'], $record['storagemin'], $record['storagemax'], $record['externalstorage'], $record['software'], $record['dateinsert']
        );
    }

    protected function toSql($search) {
        
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

    public function getAlertsToday() {
        if ($this->isConnectionSet()) {
            $sql = "select *
            from compa.search s join compa.users u on s.iduser = u.id
            where ( ( cast ( date_part('day', age(now(), s.dateinsert) ) as int) ) % s.frequency) = 0
            AND ( cast ( date_part('day', age(now(), s.dateinsert) ) as int) ) > 0";

            $record = $this->connection->executeQuery($sql);
            return $record;
        }
    }

    public function insertSearch($idUser, $url) {
        if ($this->isConnectionSet()) {
            $sqlSearch = "select count(*) from compa.search where (url) like ('$url') and iduser = $idUser";
            $recordSearch = $this->connection->executeQuery($sqlSearch);

            if ($recordSearch[0]['count'] == 0) {
                $sql = "insert into compa.search (iduser, url)
                    values ($idUser, '$url');";

                $record = $this->connection->executeQuery($sql);
                return $record;
            }
        }
    }

    public function retrieveSearchByUser($idUser) {
        if ($this->isConnectionSet()) {
            $sql = "select * from compa.search where iduser = $idUser order by frequency, dateinsert DESC";

            $record = $this->connection->executeQuery($sql);
            return $record;
        }
    }

    public function addAlertToSearch($idUser, $idSearch, $frequency) {
        if ($this->isConnectionSet()) {
            $sql = "update compa.search set frequency = $frequency where iduser = $idUser and id = $idSearch;";

            $record = $this->connection->executeQuery($sql);
            return $record;
        }
    }

    public function getCountSearch() {
        if ($this->isConnectionSet()) {
            $sql = "select count(*) from compa.search;";

            $record = $this->connection->executeQuery($sql);
            return $record[0]['count'];
        }
    }

}
