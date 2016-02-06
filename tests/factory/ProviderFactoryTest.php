<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Provider.php'); 
  require_once(__DIR__.'/../../src/factory/ProviderFactory.php'); 

/**
 * Description of ProviderFactoryTest
 *
 * @author sowf
 */
class ProviderFactoryTest extends PHPUnit_Framework_TestCase {
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
    }
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotGetProviders(){
        ProviderFactory::getInstance()->getProviders();
    }  
    
    /**
     * @test
     */
    public function shouldGetProviders(){
        ProviderFactory::getInstance()->setConnection($con);
        $this->assertTrue(ProviderFactory::getInstance()->isConnectionSet());
        $providers = UserFactory::getInstance()->getProviders();
        $this->assertNotNull($providers);
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindProvider(){
        ProviderFactory::getInstance()->setConnection(null);//to unset the connection already set before
        ProviderFactory::getInstance()->findProviderById(1);
    } 
    
     /**
     * @test
     */
    public function shouldFindProvider(){
        ProviderFactory::getInstance()->setConnection($con);//to unset the connection already set before
        $return=ProviderFactory::getInstance()->findProviderById(1);
        assertNotNull($return);
    } 
    
}
