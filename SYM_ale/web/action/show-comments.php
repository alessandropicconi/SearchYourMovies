<?php           
        include "../../db/db_conn.php";
        if(!isset($_SESSION)) session_start();

        $movieId = $_POST['movieId']; // COME            
        $sql = "SELECT * FROM comments WHERE movie_id="."$movieId"; #WHERE movie_id="."$movieId";
        $result = pg_query($conn,$sql);

        while ($row = pg_fetch_row($result)) { 
            if($row[5]==='-1') {     
?>
        
        <div class="commento"> 
            <p style="padding: 16px; border-radius:10px;width:60%;"><?php echo "$row[2]" ?>:<?php echo "$row[1]" ?></p>
            <a onclick="$('#testo-commento<?php echo $row[0] ?>').toggle()" class="bottone-rispondi">Rispondi</a>
            <button class="mostra-risposte" onclick="$('#risposte<?php echo $row[0] ?>').toggle()">Mostra Risposte</button>
            
<?php
if(isset($_SESSION['user_name']) && $_SESSION['user_name']==$row[2]){

?>
            <form method="post">
                <input type="hidden" name="movieTitle" value="<?php echo "$row[4]" ?>"/>
                <input type="hidden" name="movieId" value="<?php echo "$row[3]" ?>"/>
                <button type="submit" name="delete-comment" value="<?php echo $row[0] ?>"><i id="removeicon" class="far fa-trash-alt"></i></button>
            </form>
<?php
}
?>
        </div>
        <div> 
            <form method="post">
                <div hidden id="testo-commento<?php echo $row[0] ?>" style="padding:8px">
                    <textarea name="response-comment" type="text" cols="30" rows="1" maxlength="200" class="area_testo_commenti" style="background-color:#ccc;border-radius: 10px;border:none;resize:none;text-align:left;"></textarea>
                    <button name="response" value="<?php echo "$row[0]" ?>" class="mostra-risposte" style="">Invia</button>
                </div>
                <input type="hidden" name="movieTitle" value="<?php echo "$row[4]" ?>"/>
                <input type="hidden" name="movieId" value="<?php echo "$row[3]" ?>"/>
            </form>
        </div>
<?php 
        
        $sql_responses = "SELECT * FROM comments WHERE movie_id=$movieId AND parent_id=$row[0]";
        $res = pg_query($conn,$sql_responses); 
?> 
    <div id="risposte<?php echo $row[0] ?>" style="display:none">
<?php
        while ($rows = pg_fetch_row($res)) { 
?>

        <div id="risposta" class="commento"> 
            <p style="padding: 16px; border-radius:10px"><?php echo "$rows[2]" ?>:<?php echo "$rows[1]" ?>
            <p style="padding: 16px; border-radius:10px">Risposta a:<?php echo "$row[2]" ?>
            <form method="post">
                <button name="response" value="<?php echo "$row[0]" ?>" onclick="$('#area_testo_commenti').toggle()">Rispondi</button>
                <textarea name="response-comment" type="text" cols="30" rows="1" id="area_testo_commenti" style="background-color:#ccc;border-radius: 10px;border:none;resize:none;text-align:left; margin-bottom:8px"></textarea>
                <button type="submit" name="delete-comment" value="<?php echo "$rows[0]" ?>"><i id="removeicon" class="far fa-trash-alt"></i></button>
                <input type="hidden" name="movieTitle" value="<?php echo "$rows[4]" ?>"/>
                <input type="hidden" name="movieId" value="<?php echo "$rows[3]" ?>"/>
            </form>
        </div>


<?php 
        }
?>
    </div>
<?php
    }
    else 
    { 
?>
<?php  
    }
}
?>


