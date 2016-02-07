<?php

require_once ('Factory.php');
require_once (__DIR__.'/../model/User.php');

/**
 * The factory in charge of managing Users
 *
 * @author sowf
 */
class UserFactory extends Factory{
    protected static $tableName = "compa.users";
  
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
     * @return ProviderFactory, the Factory's singleton
     */
    public static function getInstance(){
        if(is_null(self::$instance)) {
            self::$instance = new UserFactory();  
            self::$tableName = "compa.users";
        }
        return self::$instance;
    }
  
    /**
     * gets alls users
     * @param type $idProvider the id of the user to be deleted
     * @return int, an integer corresponding to the number of lines deleted; 0 if the connection is not set yet or no line has been modified
     */
    public function getUsers() {
        return parent::getAll(self::$tableName);
    }

    /**
     * finds the user using their id
     * @param type $id the id of the user to be deleted
     * @return int, an integer corresponding to the number of lines deleted; 0 if the connection is not set yet or no line has been modified
     */
    public function findUserById($id) {
        return parent::findById(self::$tableName, $id);
    }
    
    /**
     * deletes the given user
     * @param type $id the id of the user to be deleted
     * @return int, an integer corresponding to the number of lines deleted; 0 if the connection is not set yet or no line has been modified
     */
    public function deleteUser($id) {
       return parent::delete(self::$tableName, $id);
    }
    
    /**
     * updates the given user
     * @param type $userId the id of the user to be updated
     * @param type $fields a record containing the fields to be updated
     * @return int, an integer corresponding to the number of lines updated; 0 if the connection is not set yet or no line has been modified
     */
    public function updateUser($id,$fields){
        return parent::update(self::$tableName, $id, $fields);
    }
    
    /**
     * create a new user out of the given object representing a user
     * @param type $user the new user
     */
    public function createUser($user){
       return parent::create(self::$tableName, $user);
    }
    
    /**
     * 
     * @param type $user
     * @return type
     */
    protected function toSql($user) {
        if(!is_null($user) && ($user instanceof User)){
            return "insert into compa.users(\"email\",\"password\",\"firstname\",\"lastname\") values ('".$user->getEmail()."','".$user->getPassword()."','"
                    .$user->getFirstName()."',".$user->getLastName()."')";
        }
        throw new Exception("the parameter is not an instantance of User", null, null);
   }
   
    /**
     * transforms the given record into an User object
     * @param type $record the record to be used
     * @return \User the new User
     */
    protected function toObject($record) {
        return new User(
          $record['id'],$record['firstName'],
          $record['lastName'],$record['email'],
          $record['password'],$record['dateInsert']
        );
    }
    
    public static function getTableName(){
       return self::$tableName;
    }
}
