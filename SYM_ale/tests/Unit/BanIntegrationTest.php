<?php

use App\User;

use App\Admin;

use Tests\Support\UnitTester;



class BanIntegrationTest extends \PHPUnit\Framework\TestCase {


    public function testBan(){
        $test_admin=new Admin();
        $email="simone@parrella.it"; //email admin
        $pass="simo";                 //password admin
        
        
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");//da cambiare
        $sql = "UPDATE users SET status=1 WHERE email='$email'";
        pg_query($conn, $sql);
        $sql = "UPDATE users SET is_admin=1 WHERE email='$email'";
        pg_query($conn, $sql);   

        $test_admin->doLoginB($email,$pass,$conn);   
        $user="user@test.com";                        //id user
        $sql = "UPDATE users SET status=1 WHERE email='$user'";
        pg_query($conn, $sql);  

        $result=$test_admin->doBan($user,$conn);
        $this->assertNotFalse($result);

        $sql = "SELECT * from users WHERE email='$user'";
        $result1=pg_query($conn, $sql);
        $result2 = pg_num_rows($result1);
        $this->assertGreaterThanOrEqual(1,$result2);
        while ($data = pg_fetch_assoc($result1)) {
            $this->assertEquals(0,$data['status']);
        }
        $sql = "UPDATE users SET status=1 WHERE email='$user'";
        pg_query($conn, $sql);  
    }
    public function testUnban(){
        $test_admin=new Admin();
        $email="simone@parrella.it"; //email admin
        $pass="simo";                 //password admin
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");//da cambiare
        $test_admin->doLoginB($email,$pass,$conn);   
        $user="user@test.com";                //id user
        $sql = "UPDATE users SET status=0 WHERE email='$user'";
        pg_query($conn, $sql);  
        $result=$test_admin->doUnban($user,$conn);
        $this->assertNotFalse($result);
        $sql = "SELECT *from users WHERE email='$user'";
        $result1=pg_query($conn, $sql);
        $result2 = pg_num_rows($result1);
        $this->assertGreaterThanOrEqual(1,$result2);
        while ($data = pg_fetch_assoc($result1)) {
            $this->assertEquals(1,$data['status']);
        }
        $sql = "UPDATE users SET status=1 WHERE email='$user'";
        pg_query($conn, $sql); 
    }
    public function testAlreadyBanned(){
        $test_admin=new Admin();
        $email="simone@parrella.it"; //email admin
        $pass="simo";                 //password admin
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");//da cambiare
        $test_admin->doLoginB($email,$pass,$conn);   
        $user="user@test.com";                       //id user
        $sql = "UPDATE users SET status=0 WHERE email='$user'";
        pg_query($conn, $sql);  
        $result=$test_admin->doBan($user,$conn);
        $this->assertFalse($result);
        $sql = "SELECT *from users WHERE email='$user'";
        $result1=pg_query($conn, $sql);
        $result2 = pg_num_rows($result1);
        $this->assertGreaterThanOrEqual(1,$result2);
        while ($data = pg_fetch_assoc($result1)) {
            $this->assertEquals(0,$data['status']);
        }
        $sql = "UPDATE users SET status=1 WHERE email='$user'";
        pg_query($conn, $sql);  
    }
    public function testAlreadyUnbanned(){
        $test_admin=new Admin();
        $email="simone@parrella.it"; //email admin
        $pass="simo";                 //password admin
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");//da cambiare
        $test_admin->doLoginB($email,$pass,$conn);   
        $user="user@test.com";                        //id user
        $sql = "UPDATE users SET status=1 WHERE email='$user'";
        pg_query($conn, $sql);  
        $result=$test_admin->doUnban($user,$conn);
        $this->assertFalse($result);
        $sql = "SELECT *from users WHERE email='$user'";
        $result1=pg_query($conn, $sql);
        $result2 = pg_num_rows($result1);
        $this->assertGreaterThanOrEqual(1,$result2);
        while ($data = pg_fetch_assoc($result1)) {
            $this->assertEquals(1,$data['status']);
        }
        $sql = "UPDATE users SET status=1 WHERE email='$user'";
        pg_query($conn, $sql);  
    }
    public function testBanAdmin(){
        $test_admin=new Admin();
        $email="simone@parrella.it"; //email admin
        $pass="simo";                 //password admin
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");//da cambiare
        $test_admin->doLoginB($email,$pass,$conn);                          //id admin
 
        $result=$test_admin->doBan($email,$conn);
        $this->assertFalse($result);
        $sql = "SELECT *from users WHERE email='$email'";
        $result1=pg_query($conn, $sql);
        $result2=pg_num_rows($result1);
        $this->assertGreaterThanOrEqual(1,$result2);
        while ($data = pg_fetch_assoc($result1)) {
            $this->assertEquals(1,$data['status']);
        } 
    }
}



?>