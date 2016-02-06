<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Device.php'); 
  require_once(__DIR__.'/../../src/factory/DeviceFactory.php'); 
  
class DeviceFactoryTest extends PHPUnit_Framework_TestCase{
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
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
        DeviceFactory::getInstance()->setConnection($con);
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
        DeviceFactory::getInstance()->setConnection($con);//to unset the connection already set before
        $return=DeviceFactory::getInstance()->findDeviceById(1);
        assertNotNull($return);
    }    
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotExecuteCriteriaQuery(){
        DeviceFactory::getInstance()->setConnection(null);//to unset the connection already set before
        DeviceFactory::getInstance()->findByCriteriaImpl(null,null,
                null,null,null,null,null,null,null,null,null,null,
                null,null,null,null,null,null,null,null,null,null,
                null,null,null,null,null,null,null,null,null,null,
                null,null,null,null,null);
    } 
    
     
    /**
     * @test
     */
    public function shouldExecuteCriteriaQuery(){
        DeviceFactory::getInstance()->setConnection($con);//to unset the connection already set before
        DeviceFactory::getInstance()->findByCriteriaImpl("Samsung",null,
                null,null,null,null,null,null,null,null,null,null,
                null,null,null,null,null,null,null,null,null,null,
                null,null,null,null,null,null,null,null,null,null,
                null,null,null,null,null);
    } 
    
}