<?php

/**
 * A class encapsulating a connection to a Database
 *
 * @author sowf
 */

class Connection{
  protected $pdo, $server, $user, $password, $dataBase,$dbType;
  
  /**
   * Constructor for connection class
   * @param type $server the server where the DB is located
   * @param type $user the username
   * @param type $password the user passeword
   * @param type $dataBase the DB where the connection is established
   * @param type $dbType the DB type, msql for MySql DB and pgsql for PgSql DB 
   */
  public function __construct($server, $user, $password, $dataBase,$dbType){
    $this->server = $server;
    $this->user = $user;
    $this->password = $password;
    $this->dataBase = $dataBase;
    $this->dbType=$dbType;
  }
  
  /**
   * try to connect o the DB
   * @throws Exception if the given db type is not correct
   * or an Error occured while opening the connection
   */
   public function connect(){
      if ($this->dbType == "mysql") {
            $this->pdo = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dataBase, $this->user, $this->password);
        } else if ($this->dbType == "pgsql") {
            $this->pdo = new PDO('pgsql:dbname='.$this->dataBase.';host='.$this->server, $this->user, $this->password);
        } else {
            throw new Exception("Error while connecting to the DB");
        }
    }
    
  /**
   * Checks if the connection is established
   * @return true if it is, false othewise
   */  
  public function isConnected(){
      return !is_null($this->pdo);
  }
    
    /**
     * executes a query on the databae and returns the resulting record
     * @param type $sql, the sql query to be sent 
     * @return $record, the collection of queried objects
     * @throws Exception, occur when the connection not yet established
     */
  public function executeQuery($sql){
    $record = array();
      if($this->pdo != NULL && !is_null($sql) && !($sql == "")){
        $query=$this->pdo->prepare($sql);
        $query->execute();
        while($row=$query->fetch()){
           // $record[]=$row;
          array_push($record, $row);
        }
        return $record;
      }
      throw new Exception("Connection not established yet or wrong sql", null, null);
  }
  
    /**
     * executes an update request on the databae and returns the number lines affected
     * @param type $sql, the sql update request to be sent 
     * @return nbLines, a numeric corresponding to the number of affected lines 
     * @throws Exception, occur when the connection not yet established
     */
  public function executeUpdate($sql){
    if($this->pdo != NULL && !is_null($sql) && !($sql == "")){
      $query=$this->pdo->prepare($sql);
      $query->execute();
      return $query->rowCount();
    }
    throw new Exception("Connection not established yet or wrong sql", null, null);
  } 
  
    /**
     * executes a delete request on the databae and returns the number lines affected
     * @param type $sql, the sql delete request to be sent 
     * @return nbLines, a numeric corresponding to the number of affected lines 
     * @throws Exception, occur when the connection not yet established
     */
  public function executeDelete($sql){
   if($this->pdo != NULL && !is_null($sql) && !($sql == "")){
      $query=$this->pdo->prepare($sql);
      $query->execute();
      return $query->rowCount();
    }
    throw new Exception("Connection not established yet or wrong sql", null, null);
  }
  
  /**
     * executes a request to insert a record to a table
     * @param type $sql, the sql insert request to be sent 
     * @return nbLines, a numeric corresponding to the number of affected lines 
     * @throws Exception, occur when the connection not yet established
     */
  public function executeCreate($sql){
    if($this->pdo != NULL && !is_null($sql) && !($sql == "")){
      $query=$this->pdo->prepare($sql);
      $query->execute();
      return $query->rowCount();
    }
    throw new Exception("Connection not established yet or wrong sql", null, null);
  }
  
}