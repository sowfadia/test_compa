<?php

require_once ('Factory.php');
require_once (__DIR__.'/../model/Provider.php');

/**
 * Factory in charge of managing providers
 *
 * @author sowf
 */
class ProviderFactory extends Factory{   
    private $tableName="compa.provider";
  
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
            self::$instance = new ProviderFactory();  
        }
        return self::$instance;
    }
    
    /**
     * requests all providers from the DB
     * @return $record, a collections of retieved providers or null if the connection has not been set yet
     */
    public function getProviders() {
        return parent::getAll($this->tableName);
    }

    /**
     * finds a provider by his id
     * @param type $id, the provider's id
     * @return Provider, the corresponding provider; null if the connection is not set yet or the provider does not exst
     */
    public function findProviderById($id) {
        return parent::findById($this->tableName, $id);
    }
    
    /**
     * deletes the given provider
     * @param type $idProvider the id of the provider to be deleted
     * @return int, an integer corresponding to the number of lines deleted; 0 if the connection is not set yet or no line has been modified
     */
    public function deleteProvider($idProvider) {
        return parent::delete($this->tableName, $idProvider);
    }
    
    /**
     * updates the given provider
     * @param type $idProvider the id of the provider to be updated
     * @param type $fields a record containing the fields to be updated
     * @return int, an integer corresponding to the number of lines updated; 0 if the connection is not set yet or no line has been modified
     */
    public function updateProvider($idProvider,$fields){
        return parent::update($this->tableName, $idProvider, $fields);
    }
    
    /**
     * create a new provider in the DB out of the given provider representing a provider
     * @param type $provider the new provider
     */
    public function createProvider(Provider $provider){
        return parent::create($this->tableName, $provider);
    }
    
    /**
     * creates a String to be used as a complement to the sql request to be sent to create a new provider
     * @param Provider $provider the provider
     * @return String, a string reprenting the provider
     */
    protected function toSql($provider) {
       return "(".$provider->getName().",".$provider->getEmail().",".$provider->getTelephone().","
               .$provider->getContactpage().",".$provider->getAddresse().",".$provider->getContactpreference().","
               .$provider->getDescription().",".$provider->getProfil().",".$provider->getUrlProducts().","
               .$provider->getPassword().")";
    }

    /**
     * create a new Provider object from the given record
     * @param type $record
     * @return \Provider
     */
    protected function toObject($record) {
        return new Provider(
          $record['id'],$record['name'],
          $record['email'],$record['telephone'],
          $record['contactpage'], $record['address'],
          $record['password'], $record['contactpreference'], 
          $record['profil'], $record['description'],
          $record['urlproducts']
        );
    }
}
