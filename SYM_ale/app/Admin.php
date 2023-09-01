<?php 

namespace App; //metti in app



class Admin extends User {
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
    
    

    public function doBan($email,$conn){
        include "db/db_conn.php"; 
        $status=0;
        $sql="SELECT * from users where email='$email'";
        $result = pg_query($conn, $sql); 
        while ($data = pg_fetch_assoc($result)){
            if($data['is_admin']==1 || $data['status']==0)
            return false;
        }
    ; 
        $sql = "UPDATE users SET status=$status WHERE email='$email'";
        $result = pg_query($conn, $sql);  
        return true;
}

public function doUnban($email,$conn){
    
    include "db/db_conn.php"; 
    $status=1;
    $sql="SELECT * from users where email='$email'";
    $result = pg_query($conn, $sql); 
    while ($data = pg_fetch_assoc($result)){
        if($data['is_admin']==1 || $data['status']==1)
        return false;
    }
; 
    $sql = "UPDATE users SET status=$status WHERE email='$email'";
    $result = pg_query($conn, $sql);  
    return true;
}
}





