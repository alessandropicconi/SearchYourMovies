<?php

use App\Review;





class ReviewIntegrationTest extends \PHPUnit\Framework\TestCase {

    // Utente Test nella table users
    // user_name = Test
    // email = test@test.com
    // pass = 123
    // Alla fine di ogni funzione pulisco il database
    


    public function testShowReviewWhenPost(){
        // Voglio verificare se la recensione appena postata venga inserita nel DB
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
        $check = "SELECT * FROM reviews WHERE name='$name'";
        $result1 = pg_query($conn,$check);
        $result2 = pg_num_rows($result1);
        $this->assertGreaterThanOrEqual(1,$result2);
        $this->reviewRendersCorrectly($review);

        
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);


    }

    public function testNoReviewWhenDuplicate(){
        // Voglio verificare se la recensione appena postata non venga inserita
        // se vi è già una recensione dello stesso utente
        $test_review = new Review();
        $name = "Test";
        $review = "Visible";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");

        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);

        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertNotFalse($result);
        $check = "SELECT * FROM reviews WHERE name='$name'";
        $result1 = pg_query($conn,$check);
        $result2 = pg_num_rows($result1);
        $this->assertGreaterThanOrEqual(1,$result2);
        $this->reviewRendersCorrectly($review);

        $not_visible_review = "Not Visible";
        $result = $test_review -> addReview($name,$not_visible_review,$movieId,$movieTitle,$conn);
        $this->assertFalse($result);
        $check = "SELECT * FROM reviews WHERE name='$name'";
        $result1 = pg_query($conn,$check);
        $result2 = pg_num_rows($result1);
        $this->assertGreaterThanOrEqual(1,$result2);
        $this->reviewIsDifferent($not_visible_review);

        
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);

    }

    public function testInvalidReview(){
        // Voglio verificare se la recensione non valida non viene visualizzata
        $test_review = new Review();
        $name = "Test";
        $review = "";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");

        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);

        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertFalse($result);
        $check = "SELECT * FROM reviews WHERE name='$name'";
        $result1 = pg_query($conn,$check);
        $result2 = pg_num_rows($result1);
        $this->assertLessThanOrEqual(0,$result2);
        $this->reviewIsDifferent($review);

        
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);


    }

    public function testNoReviewWhenInvalidUser(){
        // Voglio verificare se la recensione di un utente non valido non venga
        // visualizzata da nessuna parte
        $test_review = new Review();
        $name = "Invalid_User";
        $review = "test";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");

        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertFalse($result);
        $check = "SELECT * FROM reviews WHERE name='$name'";
        $result1 = pg_query($conn,$check);
        $result2 = pg_num_rows($result1);
        $this->assertLessThanOrEqual(0,$result2);

        
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);
    }

    public function testDeleteReview(){
        // Voglio verificare se la recensione di un utente non valido non venga
        // visualizzata da nessuna parte
        $test_review = new Review();
        $name = "Test";
        $review = "test";
        $movieId = 724209;
        $movieTitle = "Heart Of Stone";
        $conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");

        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);

        $result = $test_review -> addReview($name,$review,$movieId,$movieTitle,$conn);
        $this->assertTrue($result);
        
        $result = $test_review -> deleteReview($name,$movieId,$movieTitle,$conn);
        $this->assertTrue($result);

        $check = "SELECT * FROM reviews WHERE name='$name'";
        $result1 = pg_query($conn,$check);
        $result2 = pg_num_rows($result1);
        $this->assertLessThanOrEqual(0,$result2);


        
        $wipe = "DELETE FROM reviews WHERE name='$name'";
        pg_query($conn,$wipe);
    }



    public function reviewRendersCorrectly($review) {
        // Include your PHP script
        ob_start(); // Capture output
        include 'web/action/show-reviews-test.php';
        $output = ob_get_clean(); // Get captured output
        $output_string = trim(preg_replace('/\s+/', ' ', $output));

        // Define your expected HTML output
        $expectedOutput = '
        <div style="background-color: grey; padding: 8px 16px; margin-bottom: 8px; width: 100%;border-radius:10px"> 
            <p id="review-id" style="padding: 16px; border-radius:10px">Test:'.$review.'</p> 
        </div>
        <br>';

        $string = trim(preg_replace('/\s+/', ' ', $expectedOutput));

        // Assert that the actual output matches the expected output
        // $this->assertEquals($string, $output_string);
        $this->assertStringContainsString($string, $output_string);


    }

    public function reviewIsDifferent($review) {
        // Include your PHP script
        ob_start(); // Capture output
        include 'web/action/show-reviews-test.php';
        $output = ob_get_clean(); // Get captured output
        $output_string = trim(preg_replace('/\s+/', ' ', $output));

        // Define your expected HTML output
        $expectedOutput = '
        <div style="background-color: grey; padding: 8px 16px; margin-bottom: 8px; width: 100%;border-radius:10px"> 
            <p id="review-id" style="padding: 16px; border-radius:10px">Test:'.$review.'</p> 
        </div>
        <br>';

        $string = trim(preg_replace('/\s+/', ' ', $expectedOutput));

        // Assert that the actual output matches the expected output
        $this->assertNotEquals($string, $output_string);
        $this->assertStringNotContainsString($string, $output_string);
    }

}



?>