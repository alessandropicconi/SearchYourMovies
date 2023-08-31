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
    
    

    public function addReview($name,$review,$movieId,$movieTitle,$conn){
      $temp = trim(str_replace("'" , "", $review));
      $review=$temp;
      // Controllo se la recensione è valida
      if(empty($review)){
        return false;
      }

      // Controllo se l'utente è autenticato
      $check_name = "SELECT * FROM users WHERE user_name = '$name'";
      $result = pg_query($conn,$check_name);
      if(pg_num_rows($result) == 0){
        return false;
      }

      // Controllo se c'è già una dell'utente, in caso c'è già restituisco false
      $check_review = pg_query($conn,"SELECT * from reviews WHERE name='$name' AND movie_id='$movieId' AND movie_name='$movieTitle'");
      $res = pg_num_rows($check_review) == 0;
      if(!$res){
          return false;
      }
      $sql = "INSERT INTO reviews (review,name,movie_id,movie_name) VALUES ('$review','$name',$movieId,'$movieTitle')";
      $result = pg_query($conn,$sql);
      return $result!=false;  
    }


    public function deleteReview($name,$review,$movieId,$movieTitle,$conn){

      $check_name = "SELECT * FROM users WHERE user_name = '$name'";
      $result = pg_query($conn,$check_name);
      if(pg_num_rows($result) == 0){
        return false;
      }

      $check_review = pg_query($conn,"SELECT * from reviews WHERE name='$name' AND movie_id='$movieId' AND movie_name='$movieTitle'");
      $res = pg_num_rows($check_review) == 0;
      if($res){
          return false;
      }

      $sql = "DELETE FROM reviews WHERE name='$name' AND movie_id='$movieId' AND movie_name='$movieTitle'";
      $result = pg_query($conn,$sql);

      $check_review = pg_query($conn,"SELECT * from reviews WHERE name='$name' AND movie_id='$movieId' AND movie_name='$movieTitle'");
      $res = pg_num_rows($check_review) == 0;
      return $result==true; 

    }


}














?>