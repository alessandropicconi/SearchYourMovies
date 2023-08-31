<?php

use App\Review;

class ReviewUnitTest extends \PHPUnit\Framework\TestCase {

    // Utente Test nella table users
    // user_name = Test
    // email = test@test.com
    // pass = 123
    // Alla fine di ogni funzione pulisco il database
    

    public function testAddReview(){
        // Una recensione valida tornerà un oggetto
        
        $test_review = new Review();
        $name = "Test";
        $review = "test";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);
        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertNotFalse($result);
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);
    }

    public function testInvalidReview(){
        // Una recensione non valida, cioè vuota, non verrà inserita

        $test_review = new Review();
        $name = "Test";
        $review = "";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertFalse($result);
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);
    }

    public function testUserAlreadyReviewed(){
        // Se l'utente ha già recensito il film, dovrà prima cancellare la sua recensione
        // per recensire di nuovo
        $test_review = new Review();
        $name = "Test";
        $review = "test";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $test_review = new Review();
        $name = "Test";
        $review = "test";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertFalse($result);
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);
    }

    public function testInvalidUsername(){
        // Se il nome utente non appare nel database utenti, non può commentare
        $test_review = new Review();
        $name = "Invalid";
        $review = "test";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertFalse($result);
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);
    }

    public function testDeleteReview(){
        $test_review = new Review();
        $name = "Test";
        $review = "test";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);
        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertNotFalse($result);
        $result = $test_review -> deleteReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertNotFalse($result);
        $check_review = pg_query($conn,"SELECT * from reviews WHERE name='$name' AND movie_id='$movieId' AND movie_name='$movieTitle'");
        $res = pg_num_rows($check_review) == 0;
        $this->assertTrue($res);

    }

}

// Idee per integration test: verificare se la recensione viene fatta vedere nella pagina del film
// Verificare se la recensione di un utente che ha già recensito non viene inserita nel db e non viene fatta vedere
// Verificare se la recensione di un utente viene fatta vedere all'interno della propria pagina di profilo






?>