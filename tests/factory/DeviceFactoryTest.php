<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Device.php'); 
  require_once(__DIR__.'/../../src/factory/DeviceFactory.php'); 
  require_once (__DIR__.'/../../src/exception/ConnectionNotSetException.php');
  
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
        //Rajouter insert 
        $this->assertNotNull($devices);
        //Rajouter delete
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindDEvice(){
        DeviceFactory::getInstance()->unsetConnection();//to unset the connection already set before
        $this->assertFalse(DeviceFactory::getInstance()->isConnectionSet());
        DeviceFactory::getInstance()->findDeviceById(1);
    } 
    
    /**
     * @test
     */
    public function shouldFindDEvice(){
        DeviceFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        //Add insert 
        $return=DeviceFactory::getInstance()->findDeviceById(1);
        $this->assertNotNull($return);
        //$this->assertEquals ($return->getBrand(), created brand);
    }    
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotExecuteCriteriaQuery(){
        DeviceFactory::getInstance()->unsetConnection();//to unset the connection already set before
        DeviceFactory::getInstance()->findByCriteriaImpl(array(),null);
    } 
    
     /**
     * @test
     */
    public function shouldExecuteCriteriaQuery(){
        DeviceFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        //rajouter l'insertion d'un mobile avec Samsung commme brand et flash = true et external storage = true
        $criteria = array();
        $criteria['brand'] = "Samsung";
        $return = DeviceFactory::getInstance()->findByCriteriaImpl($criteria,null);
        $this->assertNotNull($return);
        $this->assertTrue(count($return) > 0);
        $tabPriorities=array();
        $tabPriorities[0]['priority'] = "price";
        $tabPriorities[0]['order'] = "ASC";
        $return = NULL;
        $return = DeviceFactory::getInstance()->findByCriteriaImpl($criteria,$tabPriorities);
        $this->assertNotNull($return);
        $this->assertTrue(count($return) > 0);
        $criteria['flash'] = true;
        $return = NULL;
        $return = DeviceFactory::getInstance()->findByCriteriaImpl($criteria,$tabPriorities);
        $this->assertNotNull($return);
        $this->assertTrue(count($return) > 0);
        $criteria['externalStorage'] = "true";
        $return = NULL;
        $return = DeviceFactory::getInstance()->findByCriteriaImpl($criteria,$tabPriorities);
        $this->assertNotNull($return);
        $this->assertTrue(count($return) < 0);
    } 
    
       /**
     * @test
     */
    public function shouldExecuteDeviceCRUD(){
        
//       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
//       $con->connect();
//       $createReturn=$con->executeCreate("insert into compa.users(\"email\",\"password\",\"firstname\",\"lastname\") values ('sow@sow.fr', 'sow', 'Fatou', 'SOW')");
//       $this->assertNotNull($createReturn);
//       $QueryReturn=$con->executeQuery("select * from compa.users where email like 'sow@sow.fr'");
//       $this->assertNotNull($QueryReturn);
//       $this->assertTrue(count($QueryReturn) > 0);
//       $updateReturn=$con->executeUpdate("update compa.users set firstname = 'Fatoumata' where id=".$QueryReturn[0]["id"]);
//       $this->assertNotNull($updateReturn);
//       $this->assertTrue($updateReturn == 1);
//       $deleteReturn=$con->executeDelete("delete from compa.users where id=".$QueryReturn[0]["id"]);
//       $this->assertNotNull($deleteReturn);
//       $this->assertTrue($deleteReturn == 1);
        
        $device = new Device(-1,1, "MyTestBrandName", "S6", 800, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        DeviceFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(DeviceFactory::getInstance()->isConnectionSet());
        $createReturn = DeviceFactory::getInstance()->createDevice($device);
        $this->assertNotNull($createReturn);
        $this->assertEquals(1,$createReturn);  
        $criteria = array();
        $criteria['brand'] = "MyTestBrandName";
        $devices = DeviceFactory::getInstance()->findByCriteriaImpl($criteria,null);
//        $deleteReturn = DeviceFactory::getInstance()->deleteDevice($devices[0]->getId());
//        $this->assertNotNull($deleteReturn);
//        $this->assertEquals(1,$deleteReturn);  
    }
    
}