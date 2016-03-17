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
      static::$con = $con;
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
        ProviderFactory::getInstance()->setConnection(static::$con);
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
        ProviderFactory::getInstance()->setConnection(static::$con);//to unset the connection already set before
        $return=ProviderFactory::getInstance()->findProviderById(1);
        $this->assertNotNull($return);
    } 
    
    /**
      * @test
      */
     public function shouldExecuteProviderCRUD(){   
         ProviderFactory::getInstance()->setConnection(self::$con);
         $this->assertTrue(ProviderFactory::getInstance()->isConnectionSet());
         $provider=new Provider(-1,"provider", "sowfadia@fds.com", "03030303",NULL,NULL,NULL,NULL,NULL,NULL,"urlproducts");
         $createReturn = ProviderFactory::getInstance()->createProvider($provider);
         $this->assertNotNull($createReturn);
         $this->assertEquals(1,$createReturn);  
         $criteria['email'] = $provider->getEmail();
         $PROVIDER_FROM_DB = ProviderFactory::getInstance()->findByCriteriaImpl($criteria);
         $this->assertNotNull($PROVIDER_FROM_DB);
         $this->assertTrue(count($PROVIDER_FROM_DB) > 0);
         
         $fields['name'] = "fff";
         $updateReturn = ProviderFactory::getInstance()->updateProvider($PROVIDER_FROM_DB[0]->getId(),$fields);
         $this->assertNotNull($updateReturn);
         $this->assertEquals(1,$updateReturn);
         $providers = ProviderFactory::getInstance()->findProviderById($PROVIDER_FROM_DB[0]->getId());
         $this->assertEquals("fff",$providers[0]->getName());
         $this->assertEquals("urlproducts",$providers[0]->getUrlproducts());
         $this->assertEquals("sowfadia@fds.com",$providers[0]->getEmail());
         $this->assertEquals("03030303",$providers[0]->getTelephone());
         $this->assertEquals(NULL,$providers[0]->getContactpage());
         
         
         $deleteReturn = ProviderFactory::getInstance()->deleteProvider($providers[0]->getId());
         $this->assertNotNull($deleteReturn);
         $this->assertEquals(1,$deleteReturn);  
     }    
    
}
