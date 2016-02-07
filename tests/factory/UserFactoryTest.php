<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/User.php'); 
  require_once(__DIR__.'/../../src/factory/UserFactory.php'); 
  require_once (__DIR__.'/../../src/exception/ConnectionNotSetException.php');

class UserFactoryTest extends PHPUnit_Framework_TestCase{
    
    private static $con;
    
    public static function setUpBeforeClass() {
      $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);  
      self::$con = $con;
    } 
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotCreateUser(){
       $user=new User(-1,"fds", "fds", "fds", "fds", new DateTime());
       $nbrow = UserFactory::getInstance()->createUser($user);
    }
    
    /** //An Exception is thrown beacause getters cannot be used on null object
     * @test
     * @expectedException Exception
     */
    public function shouldNotCreateUser2(){
        UserFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(UserFactory::getInstance()->isConnectionSet());
        UserFactory::getInstance()->createUser(NULL);
    }    
    
    /**
     * @test
     */
    public function shouldCreateUser(){
       $user=new User(-1,"fds", "fds", "fds", "fds", new DateTime());
        UserFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(UserFactory::getInstance()->isConnectionSet());
        try {
            $nbrow = UserFactory::getInstance()->createUser($user);
            $this->assertEquals(1,$nbrow);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }        
    }   
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotGetUsers(){
        UserFactory::getInstance()->unsetConnection();
        UserFactory::getInstance()->getUsers();
    }   
    
    /**
     * @test
     */
    public function shouldGetUsers(){
        UserFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(UserFactory::getInstance()->isConnectionSet());
        $users = UserFactory::getInstance()->getUsers();
        $this->assertNotNull($users);
    }  
    
    /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindUser(){
        UserFactory::getInstance()->unsetConnection();//to unset the connection already set before
        UserFactory::getInstance()->findUserById(1);
    } 
    
    /**
     * @test
     */
    public function shouldFindAndDeleteUser(){
        UserFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(UserFactory::getInstance()->isConnectionSet());
        $user=new User(-1,"XXX", "XXX", "sowfadia@hotmail.com", "XXX",(new DateTime())->getTimestamp());
        UserFactory::getInstance()->createUser($user);
        $criteria = " COALESCE(email, '') like " . $user->getEmail(). "'";
        $USER_FROM_DB = UserFactory::getInstance()->findByCriteria(UserFactory::getTableName(),$criteria);
        $this->assertNotNull($USER_FROM_DB);
        $return = UserFactory::getInstance()->findUserById($USER_FROM_DB[0]['id']);
        $this->assertNotNull($return);
        $nbrow = UserFactory::getInstance()->deleteUser($USER_FROM_DB[0]['id']);
        $this->assertNotNull($nbrow);
        $this->assertTrue($nbrow>0);
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotDeleteUser(){
       $user=new User(-1,"XXX", "XXX", "sowfadia@hotmail.com", "XXX",(new DateTime())->getTimestamp());
       UserFactory::getInstance()->createUser($user);
       UserFactory::getInstance()->unsetConnection();
       UserFactory::getInstance()->deleteUser(0);
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotUpdateUserUser(){
        UserFactory::getInstance()->unsetConnection();//to unset the connection already set before
        UserFactory::getInstance()->findUserById(1);
    } 
    
}