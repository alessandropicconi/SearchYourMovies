
<?php           
        include "../../db/db_conn.php";
        if(!isset($_SESSION)) session_start();

        $movieId = $_POST['movieId'];             
        $sql = "SELECT * FROM reviews WHERE movie_id="."$movieId"; 
        $result = pg_query($conn,$sql);

        while ($row = pg_fetch_row($result)) { ?>
        <div style="background-color: grey; padding: 8px 16px; margin-bottom: 8px; width: 100%;border-radius:10px"> 
            <p id="review-id" style="padding: 16px; border-radius:10px"><?php echo "$row[2]" ?>:<?php echo "$row[1]" ?></p> 
        </div>
        <br>
<?php }
 ?>