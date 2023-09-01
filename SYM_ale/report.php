<?php 
         include "db/db_conn.php";        
              
                 if(!isset($_SESSION)) session_start();
                if(isset($_POST['segn'])){
                  $segn =isset( $_POST['segn'] ) ? $_POST['segn'] : '' ;
                  $user = $_SESSION['user_name'];
                  
                  $res = pg_query($conn,"SELECT * from reports WHERE user_name='$user' AND report='$segn'");
                  
                  if(isset( $_POST['segn'] ) && pg_num_rows($res) == 0) {
                    $sql = "INSERT INTO reports(report,user_name) VALUES('$segn','$user')";
                    $result = pg_query($conn,$sql);
                     
                    ;
                  }
                else{
                    ;
                };
             }
              
                ?>  
    
<!DOCTYPE html>
<html>
    <body>
       La segnalazione è stata inviata con successo
<hr/>
<form> <input type="button" value="Torna indietro" onclick="window.location.href='/profiloutente.php'"><i class="fas fa-chevron-left"></i></input> 
</form>    
</body>
</hmtl>