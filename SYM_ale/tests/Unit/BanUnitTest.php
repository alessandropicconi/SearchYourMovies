<?php
//metti in test

use App\User;
use App\Admin;     
class BanUnitTest extends \PHPUnit\Framework\TestCase
{

     

    // tests
    public function testdoBan()
    {
    $test_admin=new Admin();
    $email="simone@parrella.it"; //email admin
    $pass="simo";                 //password admin
    $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");//da cambiare
    $test_admin->doLoginB($email,$pass,$conn);
    $test_user=new User();
    $user="user@test.com";                        //id user
    $sql = "UPDATE users SET status=1 WHERE email='$user'";
    pg_query($conn, $sql);  
    $result=$test_admin->doBan($user,$conn);
    $this->assertNotFalse($result);
    $email="user@test.com";      //email user
    $pass="1";                  //password user
    $result=$test_user->doLoginB($email,$pass,$conn);
    $this->assertFalse($result);
    }

    public function testdoUnban(){
        $test_admin=new Admin();
        $email="simone@parrella.it"; //email admin
        $pass="simo";                //password admin
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");//da cambiare
        $test_admin->doLoginB($email,$pass,$conn);
        $test_user=new User();
        $user="user@test.com";                   //id user
        $sql = "UPDATE users SET status=0 WHERE email='$user'";
        pg_query($conn, $sql);  
        $result=$test_admin->doUnban($user,$conn);
        $this->assertNotFalse($result);
        $email="user@test.com";       //email user
        $pass="1";                   //password user
        $result=$test_user->doLoginB($email,$pass,$conn);
        $this->assertNotFalse($result);
        $sql = "UPDATE users SET status=1 WHERE email='$user'";
        pg_query($conn, $sql); 
    }

    public function testUserBanned(){
    $test_user=new User();
    $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");//da cambiare    
    $email="user@test.com";  //email user
    $pass="1";             //password user
    $sql = "UPDATE users SET status=0 WHERE email='$email'";
    pg_query($conn,$sql);
    $result=$test_user->doLoginB($email,$pass,$conn);
    $this->assertFalse($result);
}
   
public function testBanAdmin(){
    $test_admin=new Admin();
    $email="simone@parrella.it"; //email admin
    $pass="simo";                 //password admin
    $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998"); //da cambiare
    $sql = "UPDATE users SET is_admin=1 WHERE email='$email'";
    pg_query($conn, $sql);
    $test_admin->doLoginB($email,$pass,$conn);
    $result=$test_admin->doBan($email,$conn);
    $this->assertFalse($result);
}
public function testUnbanAdmin(){
    $test_admin=new Admin();
    $email="simone@parrella.it"; //email admin
    $pass="simo";               //password admin
    $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998"); //da cambiare
    $test_admin->doLoginB($email,$pass,$conn);                     //id admin
    $result=$test_admin->doUnban($email,$conn);
    $this->assertFalse($result);
}
public function testUserAlreadyBanned(){

    $test_admin=new Admin();
    $email="simone@parrella.it";  //email admin
    $pass="simo";                 //password admin
    $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");  //da cambiare
    $test_admin->doLoginB($email,$pass,$conn);
    $id=2;                        //id user
    $sql = "UPDATE users SET status=0 WHERE id=$id";
    pg_query($conn, $sql);  
    $result=$test_admin->doBan($email,$conn);
    $this->assertFalse($result);
}

public function testUserAlreadyUnbanned(){

    $test_admin=new Admin();
    $email="simone@parrella.it";  //email admin
    $pass="simo";                      //password admin
    $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");  //da cambiare
    $test_admin->doLoginB($email,$pass,$conn);
    $user="user@test.com"; 
    $sql = "UPDATE users SET status=1 WHERE email='$user'";
    pg_query($conn, $sql);  
    $result=$test_admin->doUnban($user,$conn);
    $this->assertFalse($result);
}

}