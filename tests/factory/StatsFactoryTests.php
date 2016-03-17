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
//         $user=new User(-1,"searchUser", "searchUser", "sowfadia@sowfadia.com", "searchUser",(new DateTime())->getTimestamp());
//         UserFactory::getInstance()->setConnection(static::$con);
//         UserFactory::getInstance()->createUser($user);
//         $criteria = "email like '" . $user->getEmail(). "'";
//         $USER_FROM_DB = UserFactory::getInstance()->findByCriteria(UserFactory::getTableName(),$criteria);
//         $this->assertNotNull($USER_FROM_DB);
         
//         $stats = new Search(-1,0, 0 , 0, 0, 0);
//         StatsFactory::getInstance()->setConnection(self::$con);
//         $this->assertTrue(StatsFactory::getInstance()->isConnectionSet());
//         $createReturn = StatsFactory::getInstance()->createSearch($stats);
//         $this->assertNotNull($createReturn);
//         $this->assertEquals(1,$createReturn);  
//         $criteria = array();
//         $criteria['nbusers'] = 0;
//         $criteria['nbproviders'] = 0;
//         $criteria['nbsearch'] = 0;
//         $criteria['nbdevices'] = 0;
//         $criteria['nblinks'] = 0;
//         $stats = StatsFactory::getInstance()->findByCriteriaImpl($criteria);
//         $this->assertTrue(count($stats) > 0);
//         $fields['brand'] = "Samsung";
//         $updateReturn = StatsFactory::getInstance()->updateSearch($searches[0]->getId(),$fields);
//         $this->assertNotNull($updateReturn);
//         $this->assertEquals(1,$updateReturn);
//         $searches = StatsFactory::getInstance()->findSearchById($searches[0]->getId());
//         $this->assertEquals("Samsung",$searches[0]->getBrand());
//         $deleteReturn = StatsFactory::getInstance()->deleteSearch($searches[0]->getId());
//         $this->assertNotNull($deleteReturn);
//         $this->assertEquals(1,$deleteReturn);  
//         $nbrow = UserFactory::getInstance()->deleteUser($USER_FROM_DB[0]->getId());
     } 
     
    
}

