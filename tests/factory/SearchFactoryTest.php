<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Search.php'); 
  require_once(__DIR__.'/../../src/factory/SearchFactory.php'); 

/**
 * Description of SearchFactoryTest
 *
 * @author sowf
 */
class SearchFactoryTest extends PHPUnit_Framework_TestCase {
    
    private static $con;
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
      self::$con = $con;
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotGetSearhes(){
        SearchFactory::getInstance()->getSearches();
    }  
    
    /**
     * @test
     */
    public function shouldGetSearches(){
        SearchFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(SearchFactory::getInstance()->isConnectionSet());
        $searches = UserFactory::getInstance()->getSearches();
        $this->assertNotNull($searches);
    }
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindSearch(){
        SearchFactory::getInstance()->setConnection(null);//to unset the connection already set before
        SearchFactory::getInstance()->findSearchById(1);
    } 
    
    /**
     * @test
     */
    public function shouldFindSearch(){
        SearchFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        $return=SearchFactory::getInstance()->findSearchById(1);
        $this->assertNotNull($return);
    } 
    
}
