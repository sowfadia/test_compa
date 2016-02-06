<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Device.php'); 
  require_once(__DIR__.'/../../src/factory/DeviceFactory.php'); 
  
class DeviceFactoryTest extends PHPUnit_Framework_TestCase{
    private static $con;
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
      self::$con = $con;
    }
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotGetDevices(){
        DeviceFactory::getInstance()->getDevices();
    }  
    
    /**
     * @test
     */
    public function shouldGetDevices(){
        DeviceFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(DeviceFactory::getInstance()->isConnectionSet());
        $devices = DeviceFactory::getInstance()->getDevices();
        $this->assertNotNull($devices);
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindDEvice(){
        DeviceFactory::getInstance()->setConnection(null);//to unset the connection already set before
        DeviceFactory::getInstance()->findDeviceById(1);
    } 
    
    /**
     * @test
     */
    public function shouldFindDEvice(){
        DeviceFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        $return=DeviceFactory::getInstance()->findDeviceById(1);
        $this->assertNotNull($return);
    }    
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotExecuteCriteriaQuery(){
        DeviceFactory::getInstance()->setConnection(null);//to unset the connection already set before
        DeviceFactory::getInstance()->findByCriteriaImpl(array(),null);
    } 
    
     
    /**
     * @test
     */
    public function shouldExecuteCriteriaQuery(){
        DeviceFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        $criteria = array();
        $criteria['brand'] = "Samsung";
        DeviceFactory::getInstance()->findByCriteriaImpl($criteria,null);
    } 
    
}