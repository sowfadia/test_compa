<?php

/**
 * The factory managing search class objects
 *
 * @author sowf
 */

class SearchFactory extends Factory{
    private $tableName="compa.search";
    
      /**
     * The single instance of the factory
     */
    protected static $instance;
  
    /**
     * constructor 
     */
    public function __construct() {}
    
  /**
     * gets the unique instance of this factory
     * @return SearchFactory, the Factory's singleton
     */
    public static function getInstance(){
        if(is_null(self::$instance)) {
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
        $sql="select * from ".$tableName." where iduser=".$userId;
        $record=$this->connection->executeQuery($sql);
        if($record){
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
    
    public function createSearch(Search $search){
        return parent::create($this->tableName, $object);
    }

    protected function toObject($record) {
        return new Search(
          $record['id'],$record['iduser'],
          $record['frequency'],$record['dateinsert'],
          $record['url']
        );
    }

    protected function toSql($search) {
       return "(".$search->getId().",".$search->getIduser().",".$search->getFrequency().",".$search->getDateInsert().","
               .$search->getUrl().")";
    }

}
