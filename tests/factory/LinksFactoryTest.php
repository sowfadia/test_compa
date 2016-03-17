<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 
  require_once(__DIR__.'/../../src/model/Links.php'); 
  require_once(__DIR__.'/../../src/factory/LinksFactory.php'); 
  require_once (__DIR__.'/../../src/exception/ConnectionNotSetException.php');

/**
 * Description of LinksFactoryTest
 *
 * @author sowf
 */
class LinksFactoryTest extends PHPUnit_Framework_TestCase {
    
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
        LinksFactory::getInstance()->getLinks();
    }  
    
    /**
     * @test
     */
    public function shouldGetLinks(){
        LinksFactory::getInstance()->setConnection(self::$con);
        $this->assertTrue(LinksFactory::getInstance()->isConnectionSet());
        $linkss = LinksFactory::getInstance()->getLinks();
        $this->assertNotNull($linkss);
    }  
    
     /**
     * @test
     * @expectedException ConnectionNotSetException
     */
    public function shouldNotFindLinks(){
        LinksFactory::getInstance()->unsetConnection();//to unset the connection already set before
        LinksFactory::getInstance()->findLinkById(1);
    } 
    
    /**
     * @test
     */
    public function shouldFindLink(){
        LinksFactory::getInstance()->setConnection(self::$con);//to unset the connection already set before
        $return=LinksFactory::getInstance()->findLinkById(1);
        $this->assertNotNull($return);
    } 
    
    /**
      * @test
      */
     public function shouldExecuteLinksCRUD(){
         $user=new User(-1,"linkUser", "linkUser", "sowfadia@fds.com", "searchUser",(new DateTime())->getTimestamp());
         UserFactory::getInstance()->setConnection(static::$con);
         UserFactory::getInstance()->createUser($user);
         $criteria = "email like '" . $user->getEmail(). "'";
         $USER_FROM_DB = UserFactory::getInstance()->findByCriteria(UserFactory::getTableName(),$criteria);
         $this->assertNotNull($USER_FROM_DB);
         
         $provider=new Provider(-1,"provider", "sowfadia@fds.com", "03030303",NULL,NULL,NULL,NULL,NULL,NULL,"urlproducts");
         ProviderFactory::getInstance()->setConnection(static::$con);
         ProviderFactory::getInstance()->createProvider($provider);
         $criteria['email'] = $provider->getEmail();
         $PROVIDER_FROM_DB = ProviderFactory::getInstance()->findByCriteriaImpl($criteria);
         $this->assertNotNull($PROVIDER_FROM_DB);
         
         $link = new Links(-1,$USER_FROM_DB[0]->getId(), $PROVIDER_FROM_DB[0]->getId() , (new DateTime())->getTimestamp());
         LinksFactory::getInstance()->setConnection(self::$con);
         $this->assertTrue(LinksFactory::getInstance()->isConnectionSet());
         $createReturn = LinksFactory::getInstance()->createLink($link);
         $this->assertNotNull($createReturn);
         $this->assertEquals(1,$createReturn);  
        
         $criteria = array();
         $criteria['iduser'] = $USER_FROM_DB[0]->getId();
         $linkss = LinksFactory::getInstance()->findByCriteriaImpl($criteria);
         $this->assertEquals($USER_FROM_DB[0]->getId(),$linkss[0]->getIdUser());
         $this->assertEquals($PROVIDER_FROM_DB[0]->getId(),$linkss[0]->getIdProvider());
         
         $fields['iduser'] = $USER_FROM_DB[0]->getId();
         $updateReturn = LinksFactory::getInstance()->updateLink($linkss[0]->getId(),$fields);
         $this->assertNotNull($updateReturn);
         $this->assertEquals(1,$updateReturn);
         
         
         $linkss = LinksFactory::getInstance()->findLinkById($linkss[0]->getId());
         $this->assertEquals($USER_FROM_DB[0]->getId(),$linkss[0]->getIdUser());
         
         $deletelinkReturn = LinksFactory::getInstance()->deleteLink($linkss[0]->getId());
         $this->assertNotNull($deletelinkReturn);
         $this->assertEquals(1,$deletelinkReturn);  
         
         
         $deleteReturn = ProviderFactory::getInstance()->deleteProvider($PROVIDER_FROM_DB[0]->getId());
         $this->assertNotNull($deleteReturn);
         $this->assertEquals(1,$deleteReturn);  
         
         $nbrow = UserFactory::getInstance()->deleteUser($USER_FROM_DB[0]->getId());
         $this->assertNotNull($nbrow);
         $this->assertEquals(1,$nbrow);  
     } 
  
}

