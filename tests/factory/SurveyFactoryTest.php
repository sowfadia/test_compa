<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Survey.php'); 
  require_once(__DIR__.'/../../src/factory/SurveyFactory.php'); 

/**
 * Description of SurveryFactoryTest
 *
 * @author sowf
 */
class SurveyFactoryTest extends PHPUnit_Framework_TestCase {
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
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
        SurveryFactory::getInstance()->setConnection($con);
        $this->assertTrue(SurveryFactory::getInstance()->isConnectionSet());
        $surverys = UserFactory::getInstance()->getSurverys();
        $this->assertNotNull($surverys);
    }  
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindSurvery(){
        SearchFactory::getInstance()->setConnection(null);//to unset the connection already set before
        SearchFactory::getInstance()->findSearchById(1);
    } 
    
    /**
     * @test
     */
    public function shouldFindSurvery(){
        SurveryFactory::getInstance()->setConnection($con);//to unset the connection already set before
        $return=SurveryFactory::getInstance()->findSurveryById(1);
        assertNotNull($return);
    } 
  
}
