<?php 


namespace App;


class Review {
/*
    public $name;
    public $color;
  
    // Methods
    function set_name($name) {
      $this->name = $name;
    }

    function get_name() {
      return $this->name;
    }
*/
    
    public function checkParameters(){

    }

    public function addReview($name,$review,$movieId,$movieTitle,$conn){
            // Controllo se c'è già un commento dell'utente, in caso c'è già restituisco false
            $check_review = pg_query($conn,"SELECT * from reviews WHERE name='$name' AND movie_id='$movieId' AND movie_name='$movieTitle'");
            $res = pg_num_rows($check_review) == 0;
            if(!$res){
                return false;
            }
            $sql = "INSERT INTO reviews (review,name,movie_id,movie_name) VALUES ('$review','$name',$movieId,'$movieTitle')";
            $result = pg_query($conn,$sql);
            return $result;  
    }


}














?>