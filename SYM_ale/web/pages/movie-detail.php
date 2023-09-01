<?php include "../fragment/user-data.php";  
      include "../../db/db_conn.php"; ?>


<?php
    include "../../app/Review.php";
    if(!isset($_SESSION)) session_start();

    // per debuggare:
    // $_SESSION['movieId'] = $_POST['movieId'];
    // echo "session:" . $_SESSION['movieId'];

    if (isset($_POST['movieId']) && isset($_POST['review'])){
    $rev = new App\Review();
    $rev->addReview($_SESSION['user_name'],$_POST['review'],$_POST['movieId'],$_POST['movieTitle'],$conn);
        
    }
    



    // Se ho il movieId allora posso procedere con lo scrivere il commento
    /* 
    if (isset($_POST['movieId']) && isset($_POST['review'])){
        $name = isset( $_SESSION['user_name'] ) ? $_SESSION['user_name'] : '' ;
        $review = isset( $_POST['review'] ) ? $_POST['review'] : '' ;
        $movieId = $_POST['movieId'];
        $movieTitle = $_POST['movieTitle'];
        // Controllo se c'è già un commento dell'utente
        $res = pg_query($conn,"SELECT * from reviews WHERE name='$name' AND movie_id='$movieId' AND movie_name='$movieTitle'");
        if(isset( $_POST['review'] ) && pg_num_rows($res) == 0) {
            $sql = "INSERT INTO reviews (review,name,movie_id,movie_name) VALUES ('$review','$name',$movieId,'$movieTitle')";
            $result = pg_query($conn,$sql);
        }
        else{
            ;
        };
        
    }
    */


    if (isset($_POST['delete'])){
        $name = isset( $_SESSION['name'] ) ? $_SESSION['name'] : '' ;
        $review = isset( $_POST['review'] ) ? $_POST['review'] : '' ;
        $sql = "DELETE FROM reviews WHERE name ='$name'";
        $result = pg_query($conn,$sql);
    }


    if (isset($_POST['movieId']) && isset($_POST['comment'])){
        $name = isset( $_SESSION['user_name'] ) ? $_SESSION['user_name'] : '' ;
        $comment = isset( $_POST['comment'] ) ? $_POST['comment'] : '' ;
        $movieId = $_POST['movieId'];
        $movieTitle = $_POST['movieTitle'];
        // Controllo se c'è già un commento dell'utente
        $res = pg_query($conn,"SELECT * from comments WHERE name='$name' AND movie_id='$movieId' AND movie_name='$movieTitle'");
        if(isset( $_POST['comment'])) {
            $sql = "INSERT INTO comments (comment,name,movie_id,movie_name) VALUES ('$comment','$name',$movieId,'$movieTitle')";
            $result = pg_query($conn,$sql);
        }
        else{
            ;
        };
        
    }

    if (isset($_POST['delete-comment'])){
        $name = isset( $_SESSION['name'] ) ? $_SESSION['name'] : '' ;
        $review = isset( $_POST['review'] ) ? $_POST['review'] : '' ;
        $sql = "DELETE FROM reviews WHERE name ='$name'";
        $result = pg_query($conn,$sql);
    }
    
    if (isset($_POST['response'])){
        $parent_id = $_POST['response'];
        $name = isset( $_SESSION['user_name'] ) ? $_SESSION['user_name'] : '' ;
        $comment = isset( $_POST['response-comment'] ) ? $_POST['response-comment'] : '' ;
        $movieId = isset( $_POST['movieId'] ) ? $_POST['movieId'] : '' ;
        $movieTitle = $_POST['movieTitle'];
        $sql = "INSERT INTO comments (comment,name,movie_id,movie_name,parent_id) VALUES ('$comment','$name',$movieId,'$movieTitle',$parent_id)";
        $result = pg_query($conn,$sql);
        
        
    }

    
    if (isset($_POST['delete-comment'])){
        $id = $_POST['delete-comment'];
        $sql = "DELETE FROM comments WHERE id ='$id'";
        $result = pg_query($conn,$sql);
}

    // DEBUG: print_r($_POST);
  
?>

<!DOCTYPE html>
<html>
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titolo del sito web  -->
    <title>Pagina dei Film</title>
    
    <!-- link all'icona di fontawesome -->
    <script src="https://kit.fontawesome.com/8f0cceb3c2.js" crossorigin="anonymous"></script>  

    <!-- link al file css di stile -->
    <link rel="stylesheet" href="/styles/moviePage.css">
    <link rel="stylesheet" href="/w3styling.css">
    <link rel="stylesheet" href="/stile_ale.css">

    <!-- link a JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/script/moviePage.js"></script>
    


</head>


<body>
    <!-- pulsante di ritorno alla pagina principale -->
    <a href="/"> <button id="return-to-home"><i class="fas fa-chevron-left"></i></button></a>
    <!-- div principale -->
    <div id="main" style="display:grid;">
        <!-- il film viene visualizzato qui -->
        <div id="movie-display">
            <div class="each-movie-page"></div>
        </div>
        <!-- SEZIONE RECENSIONI E COMMENTI -->
        <div class="commenti">
            <h2 style="color:white;">Recensioni</h2>
            <div class="container_commenti" > 
            <?php if(!isset($_SESSION)) session_start();
                        if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?> 
                
                <div id="invia-commento" style="background-color: #aaa; padding: 8px 16px; margin-bottom: 8px;border-radius:10px;">
                    <p> Lascia una recensione:
                        <?php if(!isset($_SESSION)) session_start();
                        if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {         
                        echo $_SESSION['user_name'];
                        }
                        ?> </p>
                    <div id="formCommento">
                    <form method="post" id="review-section">
                        <textarea name="review" type="text" cols="20" rows="5" class="area_testo_commento"></textarea>
                    </form>
                    
                    </div>       
                </div>
                        
                <?php  } else { ?> 
                <div style="background-color: #aaa; padding: 8px 16px; margin-bottom: 8px;">      
                    <p> <a href="/web/pages/signin.php">Esegui il Login</a> o <a href="/web/pages/signup.php" style="text-decoration: none;">Registrati</a> per lasciare una recensione! </p>
                </div>
                <?php   } ?>   
                
                <?php include "../action/show-reviews.php"; ?>
                
            </div>
        </div>

        <div class="commenti">
            <h2 style="color:white;">Commenti</h2>
            <div class="container_commenti" > 
                
            <?php if(!isset($_SESSION)) session_start();
                    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?> 
                <div style="background-color: #aaa; padding: 8px 16px; margin-bottom: 8px;"> 
                    <div id="invia-commento" style="background-color: #aaa; padding: 8px 16px; margin-bottom: 8px; border-radius:10px;">
                        <p> Lascia un commento:
                        <?php if(!isset($_SESSION)) session_start();
                        if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {         
                            echo $_SESSION['user_name'];
                        }
                        ?>
                        </p>
                        <div id="formCommento">
                            <form method="post" id="comment-section">
                                <textarea name="comment" type="text" cols="30" rows="1" class="area_testo_commenti" style="background-color:#ccc;border-radius: 10px;border:none;resize:none;text-align:left; margin-bottom:8px"></textarea>
                            </form>
                        </div>       
                    </div>       
                </div>
                        
                <?php  } else { ?> 
                <div style="background-color: #aaa; padding: 8px 16px; margin-bottom: 8px;">      
                    <p> <a href="/web/pages/signin.php">Esegui il Login</a> o <a href="/web/pages/signup.php" style="text-decoration: none;"> Registrati </a> per lasciare un commento! </p>
                </div>
                <?php   } ?>   
                <?php include "../action/show-comments.php"; ?>
                
            </div>
        </div>


    </div>

    <script type="text/javascript" src="/script/moviePage.js"></script>
</body>
</html>
























<?php
/* 
                $name = isset( $_SESSION['name'] ) ? $_SESSION['name'] : '' ;
                $review = isset( $_POST['review'] ) ? $_POST['review'] : '' ;
                $sql = "SELECT * FROM reviews"; # WHERE name ='$name' 
                $result = pg_query($conn,$sql);
                while ($row = pg_fetch_row($result)) {
                echo "Utente: $row[2]  Commento: $row[1]";
                echo "<br />\n";
                }
                <div style="background-color: #aaa; padding: 8px 16px; margin-bottom: 8px; border:1px solid black; border-radius:10px; border-left:4px solid black"> 
                    <hr style="opacity:0.9">
                    <p style="background-color: grey; padding: 16px; border-radius:10px">Recensione di NomeUtente</p>
                    <hr style="opacity:0.9">
                    <p>Lorem ipsum dolor sit amet, 
                    consectetur adipiscing elit. 
                    Ut vel odio justo. 
                    Etiam lacinia elit nulla, 
                    non tristique purus sagittis ut. 
                    </p>
                    <hr style="opacity:0.9">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <hr style="opacity:0.9">
                </div>           
*/          
?>