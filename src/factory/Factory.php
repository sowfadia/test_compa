<?php

/**
 * A geric Factory
 *
 * @author sowf
 */
require_once (__DIR__.'/../exception/ConnectionNotSetException.php');

abstract class Factory {
    /**
     * The connection to the Database 
     */
    protected $connection;
    
     /**
     * Private constructor to avoid creating a new Factory
     * @param Connection $connection
     */
    public function __construct() {
    }
    
    
    /**
     * Sets the Factory's connection to the DB
     * @param Connection $connection
     */
    public function setConnection(Connection $connection) {
      if(!$connection->isConnected()){
        $connection->connect();
      }
        $this->connection = $connection;
    }
    
    public function unsetConnection() {
      $this->connection = NULL;
    }
    
     /**
     * cheks if the connection has been initiated
     * @return true if the connection has been initiated, false otherwise
     */
    public function isConnectionSet(){
        return ! is_null($this->connection);
    }
    
     /**
     * creates a String to be used as a complement to the sql request to be sent to create a new oject managed by the factory
     * @param Provider $object the provider
     * @return String, a string reprenting the object
     */
    protected abstract function toSql($object); 
    
    /**
     * Transform th given record into an object
     * @param $record the record to be transformed
     * @return String, a string reprenting the object
     */
    protected abstract function toObject($record);
     
    /**
     * requests all object managed by th subclass from the DB
     * @param tableName, the table containing objects managed 
     * @throws ConnectionNotSetException
     * @return $record, a collections of retrieved objects or null if the connection has not been set yet
     */
    public function getAll($tableName) {
        if($this->isConnectionSet()){
            $objects = array();
            $sql="select * from ".$tableName;
            $record=$this->connection->executeQuery($sql);
            if($record){
                foreach ($record as $object){
                    $objects[] = $this->toObject($object);
                }
            }
            return $objects;
        }
        throw new ConnectionNotSetException();
    }

    /**
     * finds an object by it's id
     * @param tableName, the table containing objects managed 
     * @param type $id the provider's id
     * @throws ConnectionNotSetException
     * @return Provider, the corresponding object; null if the connection is not set yet or the provider does not exst
     */
    public function findById($tableName,$id) {
        if($this->isConnectionSet()){
            $objects = array();  
            $sql="select * from ".$tableName." where id=".$id;
            $record=$this->connection->executeQuery($sql);
            if($record){
                foreach ($record as $object){
                    $objects[] = $this->toObject($object);
                }
            }
            return $objects;
        }
        throw new ConnectionNotSetException();
    }
    
    public function findByCriteria($tableName,$criteria){
      if($this->isConnectionSet()){
          $objects = array();  
            $sql="select * from ".$tableName." where ".$criteria;
            $record=$this->connection->executeQuery($sql);
            if($record && (count($record) > 0)){
                foreach ($record as $object){
                    $objects[] = $this->toObject($object);
                }
            }
            return $objects;
        }
        throw new ConnectionNotSetException();
    }
    
    /**
     * deletes the line corresponding to the given object
     * @param tableName, the table containing objects managed 
     * @param type $id the id of the object to be deleted
     * @throws ConnectionNotSetException
     * @return int, an integer corresponding to the number of lines deleted; 0 if the connection is not set yet or no line has been modified
     */
    public function delete($tableName,$id) {
        if($this->isConnectionSet()){
            $sql="delete from ".$tableName." where idProvider=".$id;
            return $this->connection->executeDelete($sql);
            
        }
        throw new ConnectionNotSetException();
    }
    
    /**
     * updates the line corresponding to the givin id
     * @param type $tableName the id of the provider to be updated
     * @param type $id the id of the provider to be updated
     * @param type $fields a record containing the fields to be updated
     * @throws ConnectionNotSetException
     * @return int, an integer corresponding to the number of lines updated; 0 if the connection is not set yet or no line has been modified
     */
    public function update($tableName,$id,$fields){
        if($this->isConnectionSet() && $fields){
            $sql="update ".$tableName." set ";
            foreach ($fields as $key => $value) {
               $sql.= $key."=".$value; 
            }
            $sql.=" where id=".$id;
            return $this->connection->executeUpdate($sql);
        }
         throw new ConnectionNotSetException();
    }
    
    /**
     * create a new provider out of the given object representing a provider
     * @param type $tableName the id of the provider to be updated
     * @param type $provider the new provider
     * @throws ConnectionNotSetException
     */
    public function create($tableName,$object){
         if($this->isConnectionSet()){
             $sql="insert into ".$tableName." values".$this->toSql($object);
             return $this->connection->executeCreate($sql);
        }
        throw new ConnectionNotSetException();
    }
  /**
  * A function to return distinct values of a table's text field 
  *
  */
   protected function getListTextFieldValues($tableName,$textfieldName) {
        if ($this->isConnectionSet()) {
            $sql = "select distinct(" . $textfieldName . ") from ".$tableName;
            $values = $this->connection->executeQuery($sql);
            return $values;
        }
        throw new ConnectionNotSetException();
    }
  
   protected function getListTextFieldValuesAndType($schema, $tableName) {
        if ($this->isConnectionSet()) {
            $sql = "select column_name, data_type from information_schema.columns where table_schema = '".$schema."' and table_name = '".$tableName."'";
            $values = $this->connection->executeQuery($sql);
            return $values;
        }
        throw new ConnectionNotSetException();
    }
}
