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
                $record['id'], 
                $record['iduser'], 
                $record['frequency'], 
                $record['dateinsert'],
                $record['url']
        );
    }

        protected function toSql($search) {
        if(!is_null($search) && ($search instanceof Search)){
            return "insert into ".$this->tableName."(\"iduser\",\"frequency\",\"url\") values ("
                     . $this->paramToSql($search->getIduser()) . "," . $this->paramToSql($search->getFrequency()) . ","
                     . $this->paramToSql($search->getId()).")";
         }
        throw new Exception("the parameter is not an instance of Search ", null, null);
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
            $sqlSearch = "select count(*) ".$this->tableName." where (url) like ('$url') and iduser = $idUser";
            $recordSearch = $this->connection->executeQuery($sqlSearch);

            if ($recordSearch[0]['count'] == 0) {
                $sql = "insert into ".$this->tableName." (iduser, url)
                    values ($idUser, '$url');";

                $record = $this->connection->executeQuery($sql);
                return $record;
            }
        }
    }

    public function retrieveSearchByUser($idUser) {
        if ($this->isConnectionSet()) {
            $sql = "select * from ".$this->tableName." where iduser = $idUser order by frequency, dateinsert DESC";

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
