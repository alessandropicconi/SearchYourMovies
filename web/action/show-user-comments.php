
<?php           
        include "/Users/Win/Desktop/SYM_ale/db/db_conn.php";
        if(!isset($_SESSION)) session_start();

        $name = $_SESSION['user_name']; // COME            
        $sql = "SELECT * FROM reviews WHERE name = '$name' "; 
        $result = pg_query($conn,$sql);

        while ($row = pg_fetch_row($result)) { ?>
        <div style="background-color: grey; padding: 8px 16px; margin-bottom: 8px; width: 100%;display:flex;border-radius:10px"> 
            <p style="padding: 16px; border-radius:10px"><?php echo "$row[2]" ?>:<?php echo "$row[1]" ?>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <br><br>
                <form action="/web/pages/movie-detail.php?id=<?php echo "$row[3]" ?>" method="post" id="myForm">
                    <input type="hidden" name="movieTitle" value="<?php echo "$row[4]" ?>" />
                    <button class="w3-button" name="movieId" value="<?php echo "$row[3]" ?>" style="background:none;border:none;cursor:pointer;"> <?php echo "$row[4]" ?>  
                    </button>
                </form>
                <form method="post" id="myForm2">
                    <input type="hidden" name="movieId" value="<?php echo "$row[3]" ?>"/>
                    <button type="submit" name="delete-review"><i id="removeicon" class="far fa-trash-alt"></i></button>
                    <button type="button" name="update-review-toggle" onclick="$('#review-update').toggle()"><i class="fa fa-pencil"></i></button>
                
                </form>
                <form method="post">
                <input type="hidden" name="movieId" value="<?php echo "$row[3]" ?>"/>
                <div id="review-update" style="display:none">
                    <textarea name="review-update"></textarea>
                    <button type="submit" name="update-review">Cambia</button>
                </div>   
                </form>      
            </p>                        
        </div>


<?php }
 ?>










