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
  
}
