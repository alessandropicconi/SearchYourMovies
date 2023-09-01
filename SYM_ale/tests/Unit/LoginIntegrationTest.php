<?php

use App\User;





class LoginIntegrationTest extends \PHPUnit\Framework\TestCase {

    // Utente Test nella table users
    // user_name = Test
    // email = test@test.com
    // pass = 123
    // Alla fine di ogni funzione pulisco il database
    


    public function testLogin(){
        // Voglio verificare se il login funziona
        // faccio il login
        // verifico che il login mi dia true
        // vedo se l'utente corrispondente appena loggatosi è nel database
        // vedo se appare Hi,Test
        $user = new User();
        $email = "test@test.com";
        $pass = "123";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertTrue($result);
        $this->assertTrue(true);
        $sql="SELECT * FROM users WHERE email='$email' AND pass = '$pass'";
        $result = pg_query($conn,$sql);
        $result2 = pg_num_rows($result);
        $this->assertLessThanOrEqual(1,$result2);
        while($row = pg_fetch_row($result)){
            $this->assertEquals($email,$row[1]);
        };

        
        
    }

    public function testInvalidLoginError(){
        // Voglio verificare se il login funziona
        // faccio il login
        // verifico che il login mi dia true
        // vedo se l'utente corrispondente appena loggatosi è nel database
        $user = new User();
        $email = "testtypo@test.com";
        $pass = "12";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
        $sql="SELECT * FROM users WHERE email='$email' AND pass = '$pass'";
        $result = pg_query($conn,$sql);
        $result2 = pg_num_rows($result);
        $this->assertLessThanOrEqual(0,$result2);
        $this->loginErrorRendersCorrectly("Incorrect Email or password");
        
    }

    public function testInvalidPasswordError(){
        // Voglio verificare se il login funziona
        // faccio il login
        // verifico che il login mi dia true
        // vedo se l'utente corrispondente appena loggatosi è nel database
        // vedo se appare Hi,Test
        $user = new User();
        $email = "test@test.com";
        $pass = "12";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
        $sql="SELECT * FROM users WHERE email='$email' AND pass = '$pass'";
        $result = pg_query($conn,$sql);
        $result2 = pg_num_rows($result);
        $this->assertLessThanOrEqual(0,$result2);
        $this->loginErrorRendersCorrectly("Incorrect Email or password");
        
    }
    
    public function testInvalidEmailError(){
        // Voglio verificare se il login funziona
        // faccio il login
        // verifico che il login mi dia true
        // vedo se l'utente corrispondente appena loggatosi è nel database
        $user = new User();
        $email = "test@test.com";
        $pass = "12";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
        $sql="SELECT * FROM users WHERE email='$email' AND pass = '$pass'";
        $result = pg_query($conn,$sql);
        $result2 = pg_num_rows($result);
        $this->assertLessThanOrEqual(0,$result2);
        $this->loginErrorRendersCorrectly("Incorrect Email or password");
    }

    public function testNoEmailError(){
        // Voglio verificare se il login funziona
        // faccio il login
        // verifico che il login mi dia true
        // vedo se l'utente corrispondente appena loggatosi è nel database
        // vedo se appare Hi,Test
        $user = new User();
        $email = "";
        $pass = "12";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
        $sql="SELECT * FROM users WHERE email='$email' AND pass = '$pass'";
        $result = pg_query($conn,$sql);
        $result2 = pg_num_rows($result);
        $this->assertLessThanOrEqual(0,$result2);
        $this->loginErrorRendersCorrectly("Email is required");
    }

    public function testNoPasswordError(){
        // Voglio verificare se il login funziona
        // faccio il login
        // verifico che il login mi dia true
        // vedo se l'utente corrispondente appena loggatosi è nel database
        // vedo se appare Hi,Test
        $user = new User();
        $email = "test@test.com";
        $pass = "12";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $user->doLoginB($email,$pass,$conn);
        $this->assertFalse($result);
        $sql="SELECT * FROM users WHERE email='$email' AND pass = '$pass'";
        $result = pg_query($conn,$sql);
        $result2 = pg_num_rows($result);
        $this->assertLessThanOrEqual(0,$result2);
        $this->loginErrorRendersCorrectly("Password is required");
    }

    protected function setUpError($error): void
    {
        parent::setUp();

        // Modifico $_GET prima del test
        $_GET['error'] = $error;
    }

    protected function tearDown(): void
    {
        // Resetto $_GET dopo i test
        unset($_GET['error']);

        parent::tearDown();
    }

    public function loginErrorRendersCorrectly($error) {
        ob_start(); // Inizio cattura output

        $this->setUpError($error);

        include 'web/pages/login-error.php';
        $output = ob_get_clean(); // Salva l'output catturato in variabile
        $output_string = trim(preg_replace('/\s+/', ' ', $output));

        // Output desiderato
        $expectedOutput = '    <div class="alert alert-warning d-flex align-items-center" role="alert">
	    <svg class="bi flex-shrink-0 me-2 icon-warning" role="img" aria-label="Warning:">
        <use xlink:href="#exclamation-triangle-fill"/>
        </svg>
    <div>
            '.$error.'
        </div>
    </div>';

        $string = trim(preg_replace('/\s+/', ' ', $expectedOutput));

        // Assert that the actual output matches the expected output
        $this->assertEquals($string, $output_string);
        $this->tearDown();
    }



}



/*    
<div class="alert alert-warning d-flex align-items-center" role="alert">
	    <svg class="bi flex-shrink-0 me-2 icon-warning" role="img" aria-label="Warning:">
        <use xlink:href="#exclamation-triangle-fill"/>
        </svg>
    <div>
            <?php echo $_GET['error']; ?>
        </div>
    </div>
*/


?>