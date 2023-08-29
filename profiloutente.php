<!DOCTYPE html>
<html>

<head>

    <?php include "web/fragment/user-data.php"; ?>
    
    <!-- website title  -->
    <title>SYM</title>

    <!-- link all'icona di fontawesome -->
    <script src="https://kit.fontawesome.com/8f0cceb3c2.js" crossorigin="anonymous"></script>

    <!-- style css link  -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="w3styling.css">
    <link rel="stylesheet" href="styles/myfav.css">
    <link rel="stylesheet" href="styles/scrollbar.css">

    <!--JQuery link-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="/script/myfav.js"></script>

</head>


<?php 
        if (isset($_POST['delete-review'])){
            $name = isset( $_SESSION['user_name'] ) ? $_SESSION['user_name'] : '' ;
            $review = isset( $_POST['review'] ) ? $_POST['review'] : '' ;
            $movieId = isset( $_POST['movieId'] ) ? $_POST['movieId'] : '' ;
            $sql = "DELETE FROM reviews WHERE name ='$name' AND movie_id='$movieId'";
            $result = pg_query($conn,$sql);
        }
?>


    
<?php 
        if (isset($_POST['update-review'])){
            $name = isset( $_SESSION['user_name'] ) ? $_SESSION['user_name'] : '' ;
            $review = isset( $_POST['review'] ) ? $_POST['review'] : '' ;
            $movieId = isset( $_POST['movieId'] ) ? $_POST['movieId'] : '' ;
            $new_review = isset( $_POST['review-update'] ) ? $_POST['review-update'] : '' ;
            if($new_review!=''){
                $sql = "UPDATE reviews
                SET review = '$new_review' 
                WHERE name ='$name' AND movie_id='$movieId';";
                $result = pg_query($conn,$sql);
            }
            
        }
?>









<body>

<div style="z-index:1; width:100%">
  <div class="w3-bar w3-grey w3-left-align w3-large">
    <a href="/index.php" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white"><i class="fa fa-home w3-margin-right"></i> Home </a>
    <a href="/account_data.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Account </i></a>
    <?php if(!isset($_SESSION)) session_start(); if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>
                <a href="web/action/do-logout.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Logout </i></a>
                <?php } else { ?>
                <?php } ?>
  </div>
</div>


<!-- Questo è il div (contenitore) principale del sito web  -->
<div id="main" style="background-color:black;">

  


<!-- Contenitore Pagina Centrale, diviso in COLONNA SX e COLONNA CENTRALE -->
<div class="w3-container w3-content palette-netflix-black" style="max-width:1400px; margin-top: 80px;">    
  <!-- Griglia -->
  <div class="w3-row">
    <!-- Colonna Sinistra -->
    <div class="w3-col m3">
      <!-- Profilo -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">Salve, <?php echo $_SESSION['user_name']; ?>
         </h4> 
         <p class="w3-center">

         <?php
          include "../SYM_ale/db/db_conn.php"; 
          $user_name = $_SESSION['user_name'];
          $query = "SELECT * from image WHERE user_name='$user_name'";
          $result = pg_query($conn, $query);
 
          while ($data = pg_fetch_assoc($result)) {
          ?>
            <img class="profile_image w3-circle" alt="avatar" style="height:106px;width:106px" src="/uploads/<?php echo $data['filename']; ?>">
 
          <?php
          }
          ?>

          </p>
        </div>
      </div>
    <br>
    </div>
    <!-- Fine Colonna Sinistra -->
    
    
    <!-- Colonna Centrale -->
    <div class="w3-col m7">
      <div class="w3-container w3-card w3-white w3-round" style="margin-left:16px; max-height:800px;overflow:scroll">
        <h3>I tuoi film preferiti</h3>
        <hr class="w3-clear">
        <!-- Movie Container-->
        <div id="movie-container" style="background-color:white">
          <div class="movie-element"></div>
        </div>
        <!-- qui verranno visualizzati tutti i film preferiti -->
        <div id="list-container"></div>     
        <!-- Navigazione Pagina-->
      </div>
      <div class="w3-container w3-card w3-white w3-round" style="margin-left:16px;margin-top:2px; max-height:800px;overflow:scroll">
        <button class="w3-button palette-netflix-bright-red"  style="margin-bottom:16px;margin-top:16px" onclick="cancellaTutto();"> Rimuovi tutto </button>
        <button type="button" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px; margin-top:16px">
        <a href="/index.php" style="text-decoration:none;">Aggiungi un Film</a>  </button>
        <div class="w3-row-padding" style="margin:0 -16px">
        </div>
      </div>
      
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <h3>Le tue recensioni</h3><br>
        <hr class="w3-clear">
        <p>Visualizza qui le tue recensioni di film</p>
          <div class="w3-row-padding" style="margin:0 -16px"> 
          <?php include "web/action/show-user-comments.php";?>
        </div>
        <div class="w3-padding-16">
        <button type="button" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;">
        <a href="/index.php" style="text-decoration:none;">Aggiungi una Recensione</a></button>
        <form style="display: inline-block;">
        <button type="submit" class="bottone palette-netflix-bright-red w3-padding-16" name="delete" style="border: none;"> Cancella tutto
        </button>
        </form>

        <button id="segnala" type="button" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;" onclick="toggleForm()">
        Segnala</button>
        <hr>
        <div class="formPopup" id="popupForm" style="display: none;">
            <form action ="report.php" method ="post" id="form"> 
              Inserisci la segnalazione qui</br>             <!-- CSS  style="border :1px solid #ccc;margin-top: 10px;width :auto;height: auto;padding: 5px; display: blocK;"-->
              <textarea name="segn" type="text" rows="8" cols="40"></textarea>
              <button type="submit" class="btn"  >Invia</button>  
              <button type ="button"class="btn cancel" onclick="toggleForm()">Chiudi</button>
            </form>   
          </div>



      </div> 
    </div>
    <!-- End Middle Column -->
  </div>

  
  <!-- End Grid -->
</div>
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container palette-netflix-bright-red w3-padding-16">
  <h5>SYM</h5>
</footer>

<footer class="w3-container w3-grey">
  <p>Natalia Mucha, Simone Parrella, Alessandro Picconi</a></p>
</footer>
















<!-- Il codice JavaScript per la pagina principale è collegato qui -->

<script type="text/javascript" src="script/script.js"></script>

</body>
</html>
