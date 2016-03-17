<?php

require_once ('Factory.php');
require_once (__DIR__ . '/../model/Links.php');
class LinksFactory extends Factory {
    private $tableName = "compa.links";
    protected static $instance;
    public function __construct() { 
        
    }
    public static function getInstance() {
        if (is_null(static::$instance)) {
            static::$instance = new LinksFactory();
        }
        return static::$instance;
    }
    public function getLinks() {
        return parent::getAll($this->tableName);
    }

  public function createLink($link) {
        return parent::create($this->tableName, $link);
    }
    
    public function findLinkById($id) {
        return parent::findById($this->tableName, $id);
    }
    
    public function deleteLink($id) {
       return parent::delete($this->tableName, $id);
    } 
    
    public function updateLink($id,$fields){
        return parent::update($this->tableName, $id, $fields);
    }

    protected function toObject($record) {
        return new Links(
                $record['id'], $record['iduser'], $record['idprovider'], $record['dateinsert']
        );
    }
    protected function toSql($link) {
        return "insert into ".$this->tableName." (\"iduser\",\"idprovider\") values (" 
                . $this->paramToSql($link->getIdUser()).",".$this->paramToSql($link->getIdProvider()).")";
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
?>