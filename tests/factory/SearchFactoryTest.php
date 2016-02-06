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
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
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
        SearchFactory::getInstance()->setConnection($con);
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
        SearchFactory::getInstance()->setConnection($con);//to unset the connection already set before
        $return=SearchFactory::getInstance()->findSearchById(1);
        assertNotNull($return);
    } 
    
}
