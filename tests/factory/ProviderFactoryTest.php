<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Provider.php'); 
  require_once(__DIR__.'/../../src/factory/ProviderFactory.php'); 
  require_once (__DIR__.'/../../src/exception/ConnectionNotSetException.php');

/**
 * Description of ProviderFactoryTest
 *
 * @author sowf
 */
class ProviderFactoryTest extends PHPUnit_Framework_TestCase {
    
    private static $con;
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
      self::$con = $con;
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
        ProviderFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(ProviderFactory::getInstance()->isConnectionSet());
        $providers = ProviderFactory::getInstance()->getProviders();
        $this->assertNotNull($providers);
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindProvider(){
        ProviderFactory::getInstance()->unsetConnection();//to unset the connection already set before
        ProviderFactory::getInstance()->findProviderById(1);
    } 
    
     /**
     * @test
     */
    public function shouldFindProvider(){
        ProviderFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        $return=ProviderFactory::getInstance()->findProviderById(50);
        $this->assertNotNull($return);
    } 
    
     /**
     * @test
     */
    public function shouldExecuteProviderCRUD(){
        $provider = new Provider(-1,"ProviderTestName", "provider@provider.fr", "00000000", "http://mypage.fr", "1 Provider Road 59 ProviderLand", "test", 1, NULL, NULL, "http://mypage.fr/myproducts");
        ProviderFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(ProviderFactory::getInstance()->isConnectionSet());
        $createReturn = ProviderFactory::getInstance()->createProvider($provider);
        $this->assertNotNull($createReturn);
        $this->assertEquals(1,$createReturn);  
        $criteria = array();
        $criteria['email'] = "provider@provider.fr";
        $providers = ProviderFactory::getInstance()->findByCriteriaImpl($criteria);
        $this->assertEquals("ProviderTestName",$providers[0]->getName());
        $fields['name'] = "ProviderTestName2";
        $updateReturn = ProviderFactory::getInstance()->updateProvider($providers[0]->getId(),$fields);
        $this->assertNotNull($updateReturn);
        $this->assertEquals(1,$updateReturn);
        $providers = ProviderFactory::getInstance()->findProviderById($providers[0]->getId());
        $this->assertEquals("ProviderTestName2",$providers[0]->getName());
        $deleteReturn = ProviderFactory::getInstance()->deleteProvider($providers[0]->getId());
        $this->assertNotNull($deleteReturn);
        $this->assertEquals(1,$deleteReturn);  
    } 
    
}
