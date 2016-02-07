<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/User.php'); 
  require_once(__DIR__.'/../../src/factory/UserFactory.php'); 

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
       $user=new User(-1,"fds", "fds", "fds", "fds", "Lille1", "fds", "fds", "sms", new DateTime());
       $nbrow = UserFactory::getInstance()->createUser($user);
    }
    
    /** //An Exception is thrown beacause getters cannot be used on null object
     * @test
     * @expectedException Exception
     */
    public function shouldNotCreateUser2(){
        UserFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(UserFactory::getInstance()->isConnectionSet());
        UserFactory::getInstance()->createUser(null);
    }    
    
    /**
     * @test
     */
    public function shouldCreateUser(){
        $user=new User(-1,"fds", "fds", "fds", "fds", "Lille1", "fds", "fds", "sms", (new DateTime())->getTimestamp());
        UserFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(UserFactory::getInstance()->isConnectionSet());
        $nbrow = UserFactory::getInstance()->createUser($user);
        $this->assertEquals(1,$nbrow);
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
    public function shouldFindUser(){
        UserFactory::getInstance()->setConnection(self::$con);
        $user=new User(-1,"XXX", "XXX", "sowfadia@hotmail.com", "XXX", "XXX", "XXX", "XXX", "sms", new DateTime());
        UserFactory::getInstance()->createUser($user);
        $criteria = " COALESCE(email, '') like" . $user->getEmail(). "'";
        $USER_FROM_DB = UserFactory::getInstance()->findByCriteria(UserFactory::getTableName(),$criteria);
        $this->assertNotNull($USER_FROM_DB);
        $return = UserFactory::getInstance()->findUserById($USER_FROM_DB[0]['id']);
        $this->assertNotNull($return);
        UserFactory::getInstance()->deleteUser($USER_FROM_DB[0]['id']);
    } 
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotDeleteUser(){
       $user=new User(-1,"XXX", "XXX", "sowfadia@hotmail.com", "XXX", "XXX", "XXX", "XXX", "sms", new DateTime());
       UserFactory::getInstance()->createUser($user);
       UserFactory::getInstance()->setConnection(null);
       UserFactory::getInstance()->deleteUser(0);
    } 
    
    /**
     * @test
     * 
     */
    public function shouldDeleteUser(){
       UserFactory::getInstance()->setConnection(self::$con);
       $criteria = " COALESCE(email, '') like" . $user->getEmail(). "'";
       $USER_FROM_DB = UserFactory::getInstance()->findByCriteria(UserFactory::getTableName(),$criteria);
       $nbrow = UserFactory::getInstance()->deleteUser($USER_FROM_DB[0]['id']);
       $this->assertNotNull($nbrow);
       $this->assertTrue($nbrow>0);
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