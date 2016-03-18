<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Survey.php'); 
  require_once(__DIR__.'/../../src/factory/SurveyFactory.php'); 
  require_once (__DIR__.'/../../src/exception/ConnectionNotSetException.php');

/**
 * Description of SurveryFactoryTest
 *
 * @author sowf
 */
class SurveyFactoryTest extends PHPUnit_Framework_TestCase {
    
    private static $con;
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
      self::$con = $con;
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotGetSurvereys(){
        SurveyFactory::getInstance()->getSurveys();
    }  
    
    /**
     * @test
     */
    public function shouldGetSurverys(){
        SurveyFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(SurveyFactory::getInstance()->isConnectionSet());
        $surverys = SurveyFactory::getInstance()->getSurveys();
        $this->assertNotNull($surverys);
    }  
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindSurvery(){
        SurveyFactory::getInstance()->unsetConnection();//to unset the connection already set before
        SurveyFactory::getInstance()->findSurveyById(1);
    } 
    
    /**
     * @test
     */
    public function shouldFindSurvery(){
        SurveyFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        $return=SurveyFactory::getInstance()->findSurveyById(1);
        $this->assertNotNull($return);
    } 
    
    /**
      * @test
      */
     public function shouldExecuteSurveyCRUD(){
         $user=new User(-1,"searchUser", "searchUser", "sowfadia@fds.com", "searchUser",(new DateTime())->getTimestamp());
         UserFactory::getInstance()->setConnection(static::$con);
         UserFactory::getInstance()->createUser($user);
         $criteria = "email like '" . $user->getEmail(). "'";
         $USER_FROM_DB = UserFactory::getInstance()->findByCriteria(UserFactory::getTableName(),$criteria);
         $this->assertNotNull($USER_FROM_DB);
         
         $search = new Search(-1,$USER_FROM_DB[0]->getId(), NULL , NULL, NULL);
         SearchFactory::getInstance()->setConnection(self::$con);
         $this->assertTrue(SearchFactory::getInstance()->isConnectionSet());
         $createReturn = SearchFactory::getInstance()->createSearch($search);
         $this->assertNotNull($createReturn);
         $this->assertEquals(1,$createReturn);  
        
         $criteria = array();
         $criteria['iduser'] = $USER_FROM_DB[0]->getId();
         $searches = SearchFactory::getInstance()->findByCriteriaImpl($criteria);
         $this->assertEquals($USER_FROM_DB[0]->getId(),$searches[0]->getIduser());
         
         
         $survey = new Survey(-1,$USER_FROM_DB[0]->getId(), $searches[0]->getId() , 10);
         SurveyFactory::getInstance()->setConnection(self::$con);
         $this->assertTrue(SurveyFactory::getInstance()->isConnectionSet());
         $createSurveyReturn = SurveyFactory::getInstance()->createSurvey($survey);
         $this->assertNotNull($createReturn);
         $this->assertEquals(1,$createReturn); 
         
         $surveys = SurveyFactory::getInstance()->findByCriteriaImpl($criteria);
         $this->assertNotNull($surveys);
         $this->assertEquals($USER_FROM_DB[0]->getId(),$surveys[0]->getIduser());
         $this->assertEquals($surveys[0]->getIdsearch(),$surveys[0]->getIdsearch());
         $this->assertEquals(10,$surveys[0]->getNote());
    
         
         $fields['note'] = 25;
         $updateReturn = SurveyFactory::getInstance()->updateSurvey($searches[0]->getId(),$fields);
         $this->assertNotNull($updateReturn);
         $this->assertEquals(1,$updateReturn);
         
         
         $surveys = SurveyFactory::getInstance()->findSurveyById($surveys[0]->getId());
         $this->assertEquals(25,$surveys[0]->getNote());
         
         $deleteSurveyReturn = SurveyFactory::getInstance()->deleteSurvey($surveys[0]->getId());
         $this->assertNotNull($deleteSurveyReturn);
         $this->assertEquals(1,$deleteSurveyReturn);  
         
         
         $deleteReturn = SearchFactory::getInstance()->deleteSearch($searches[0]->getId());
         $this->assertNotNull($deleteReturn);
         $this->assertEquals(1,$deleteReturn);  
         $nbrow = UserFactory::getInstance()->deleteUser($USER_FROM_DB[0]->getId());
         $this->assertNotNull($nbrow);
         $this->assertEquals(1,$nbrow);  
     } 
  
}
