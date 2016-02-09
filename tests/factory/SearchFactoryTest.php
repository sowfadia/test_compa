<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Search.php'); 
  require_once(__DIR__.'/../../src/factory/SearchFactory.php'); 
  require_once (__DIR__.'/../../src/exception/ConnectionNotSetException.php');

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
        $searches = SearchFactory::getInstance()->getSearches();
        $this->assertNotNull($searches);
    }
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindSearch(){
        SearchFactory::getInstance()->unsetConnection();//to unset the connection already set before
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
    
     /**
     * @test
     */
    public function shouldExecuteSearchCRUD(){
        $user=new User(-1,"searchUser", "searchUser", "sowfadia@sowfadia.com", "searchUser",(new DateTime())->getTimestamp());
        UserFactory::getInstance()->setConnection(static::$con);
        UserFactory::getInstance()->createUser($user);
        $criteria = "email like '" . $user->getEmail(). "'";
        $USER_FROM_DB = UserFactory::getInstance()->findByCriteria(UserFactory::getTableName(),$criteria);
        $this->assertNotNull($USER_FROM_DB);
        
        $search = new Search(-1,$USER_FROM_DB[0]->getId(), NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        SearchFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(SearchFactory::getInstance()->isConnectionSet());
        $createReturn = SearchFactory::getInstance()->createSearch($search);
        $this->assertNotNull($createReturn);
        $this->assertEquals(1,$createReturn);  
        $criteria = array();
        $criteria['iduser'] = $USER_FROM_DB[0]->getId();
        $searches = SearchFactory::getInstance()->findByCriteriaImpl($criteria);
        $this->assertEquals($USER_FROM_DB[0]->getId(),$searches[0]->getUser());
        $fields['brand'] = "Samsung";
        $updateReturn = SearchFactory::getInstance()->updateSearch($searches[0]->getId(),$fields);
        $this->assertNotNull($updateReturn);
        $this->assertEquals(1,$updateReturn);
        $searches = SearchFactory::getInstance()->findSearchById($searches[0]->getId());
        $this->assertEquals("Samsung",$searches[0]->getBrand());
        $deleteReturn = SearchFactory::getInstance()->deleteSearch($searches[0]->getId());
        $this->assertNotNull($deleteReturn);
        $this->assertEquals(1,$deleteReturn);  
        $nbrow = UserFactory::getInstance()->deleteUser($USER_FROM_DB[0]->getId());
    } 
    
}
