<?php

/**
 * Description of FactoryTest
 *
 * @author sowf
 */
require_once(__DIR__.'/../config/config.php'); 
require_once(__DIR__.'/../../src/utils/Connection.php'); 
require_once(__DIR__.'/../../src/factory/DeviceFactory.php'); 
require_once(__DIR__.'/../../src/model/User.php'); 

class FactoryTest extends PHPUnit_Framework_TestCase{
    
   private static $con;
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
      self::$con = $con;
    }
}