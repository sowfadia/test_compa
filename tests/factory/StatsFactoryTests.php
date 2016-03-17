<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Stats.php'); 
  require_once(__DIR__.'/../../src/factory/StatsFactory.php'); 
  require_once (__DIR__.'/../../src/exception/ConnectionNotSetException.php');

/**
 * Description of StatsFactoryTest
 *
 * @author sowf
 */
class StatsFactoryTests extends PHPUnit_Framework_TestCase {
    
    private static $con;
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
      self::$con = $con;
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotGetStats(){
        StatsFactory::getInstance()->getSearches();
    }  
    
    /**
     * @test
     */
    public function shouldGetStats(){
        StatsFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(StatsFactory::getInstance()->isConnectionSet());
        $searches = StatsFactory::getInstance()->getStats();
        $this->assertNotNull($searches);
    }
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindStats(){
        StatsFactory::getInstance()->unsetConnection();//to unset the connection already set before
        StatsFactory::getInstance()->findSearchById(1);
    } 
    
    /**
     * @test
     */
    public function shouldFindSearch(){
        StatsFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        $return=StatsFactory::getInstance()->findStatsById(1);
        $this->assertNotNull($return);
    } 
    
   /**
      * @test
      */
     public function shouldExecuteStatsCRUD(){   
         $stats = new Stats(-1,-1, -1 , -1, -1, -1);
         StatsFactory::getInstance()->setConnection(self::$con);
         $this->assertTrue(StatsFactory::getInstance()->isConnectionSet());
         $createReturn = StatsFactory::getInstance()->createStats($stats);
         $this->assertNotNull($createReturn);
         $this->assertEquals(1,$createReturn);  
         $criteria = array();
         $criteria['nbusers'] = -1;
         $criteria['nbproviders'] = -1;
         $criteria['nbsearch'] = -1;
         $criteria['nbdevices'] = -1;
         $criteria['nblinks'] = -1;
         $statss = StatsFactory::getInstance()->findByCriteriaImpl($criteria);
         $this->assertTrue(count($statss) > 0);
         
         $fields['nbdevices'] = -2;
         $updateReturn = StatsFactory::getInstance()->updateSearch($statss[0]->getId(),$fields);
         $this->assertNotNull($updateReturn);
         $this->assertEquals(1,$updateReturn);
         $statss = StatsFactory::getInstance()->findSearchById($statss[0]->getId());
         $this->assertEquals(-2,$statss[0]->getNbdevices());
         $this->assertEquals(-1,$statss[0]->getNbsearch());
         $this->assertEquals(-1,$statss[0]->getNbproviders());
         $this->assertEquals(-1,$statss[0]->getNbusers());
         $this->assertEquals(-1,$statss[0]->getNblinks());
         
         
         $deleteReturn = StatsFactory::getInstance()->deleteStats($statss[0]->getId());
         $this->assertNotNull($deleteReturn);
         $this->assertEquals(1,$deleteReturn);  
     }    
}

