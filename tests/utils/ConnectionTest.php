<?php

  require_once(__DIR__.'/../config/config.php'); 
  require_once(__DIR__.'/../../src/utils/Connection.php'); 

class ConnectionTest extends PHPUnit_Framework_TestCase{
    
    /**
     * @test 
     */
    public function shouldCreateConnectionObject(){
        $con = new Connection(DB_HOST,DB_PORT,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
        $this->assertNotNull($con);
    }
    
    /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->executeQuery("");
    }
    
    /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception2(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,"xxxxx");
       $con->connect();
    }
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception3(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $con->executeQuery(null);
    }  
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception14(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $con->executeQuery("");
    }
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception4(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,"");
       $con->connect();
    }  
    
    /**
     * @test 
     */
    public function shouldConnectAndCreatePDOConnection(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $this->assertTrue($con->isConnected());
    }
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception5(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->executeUpdate("");
    }
    
    /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception6(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $con->executeUpdate("");
    }
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception7(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $con->executeUpdate(null);
    
    }  
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception8(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->executeDelete("");
    }
    
    /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception9(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $con->executeDelete("");
    }
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception10(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $con->executeDelete(null);
    
    }
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception11(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->executeCreate("");
    }
    
    /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception12(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $con->executeCreate("");
    }
    
     /**
     * @test 
     * @expectedException Exception
     */
    public function shouldThrowAnExcception13(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $con->executeCreate(null);
    
    }  
    
    /**
     * @test 
     */
    public function shouldExecuteCRUD(){
       $con = new Connection(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_TYPE);
       $con->connect();
       $createReturn=$con->executeCreate("insert into compa.users(\"email\",\"password\",\"firstname\",\"lastname\") values ('sow@sow.fr', 'sow', 'Fatou', 'SOW')");
       $this->assertNotNull($createReturn);
       $QueryReturn=$con->executeQuery("select * from compa.users where email like 'sow@sow.fr'");
       $this->assertNotNull($QueryReturn);
       $this->assertTrue(count($QueryReturn) > 0);
       $updateReturn=$con->executeUpdate("update compa.users set firstname = 'Fatoumata' where id=".$QueryReturn[0]["id"]);
       $this->assertNotNull($updateReturn);
       $this->assertTrue($updateReturn == 1);
       $deleteReturn=$con->executeDelete("delete from compa.user where id=".$QueryReturn[0]["id"]);
       $this->assertNotNull($deleteReturn);
       $this->assertTrue($deleteReturn == 1);
    }
}