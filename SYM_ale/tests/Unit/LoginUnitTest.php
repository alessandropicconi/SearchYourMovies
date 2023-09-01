<?php

use App\User;

class LoginUnitTest extends \PHPUnit\Framework\TestCase {

    // Utente Test nella table users
    // user_name = Test
    // email = test@test.com
    // pass = 123
    // Alla fine di ogni funzione pulisco il database
    

    public function testValidLogin(){
        // Login valido torna true
        $user = new User();
        $email = "test@test.com";
        $pass = "123";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertTrue($result);
       
    }

    public function testValidData(){
        $user = new App\User;
        $data = "    hello@user.com            ";
        $expected = "hello@user.com";
        $result = $user->valid_input($data);
        $this->assertEquals($result,$expected);

    }

    public function testInvalidPassword(){
        // Login non valido torna false
        $user = new User();
        $email = "test@test.com";
        $pass = "12";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
       
    }
    public function testInvalidEmail(){
        // Login non valido torna false
        $user = new User();
        $email = "testtypo@test.com";
        $pass = "123";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
       
    }
    public function testEmptyPass(){
        // Login non valido torna false
        $user = new User();
        $email = "testtypo@test.com";
        $pass = "";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
       
    }
    public function testEmptyEmail(){
        // Login non valido torna false
        $user = new User();
        $email = "";
        $pass = "123";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
       
    }


}

// Idee per integration test: verificare se la recensione viene fatta vedere nella pagina del film
// Verificare se la recensione di un utente che ha già recensito non viene inserita nel db e non viene fatta vedere
// Verificare se la recensione di un utente viene fatta vedere all'interno della propria pagina di profilo






?>