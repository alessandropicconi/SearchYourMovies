<?php
 
session_start();
 if (($_SESSION['is_admin']==0) ){
 header('location:/../../Error.php');
}
?>
<!DOCTYPE html>
<html>

<head>

    <?php include "../fragment/admin-data.php";
          include "../fragment/user-data.php";
  ?>
    
    <!-- website title  -->
    <title>SYM</title>

    <!-- link all'icona di fontawesome -->
    <script src="https://kit.fontawesome.com/8f0cceb3c2.js" crossorigin="anonymous"></script>

    <!-- style css link  -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="w3styling.css">
    <link rel="stylesheet" href="/styles/myfav.css">
    <link rel="stylesheet" href="styles/scrollbar.css">

    <!--JQuery link-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
   
</head>
 
<body>
 
<div  style="z-index:1; width:100%">
 <!--Pulsanti per azioni di base-->
 <div class="w3-bar w3-grey w3-left-align w3-large">
  <a href="/index.php" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white"><i class="fa fa-home w3-margin-right"></i> Home </a> 
  <a href="/web/pages/admin.php" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white"> Admin Page </a> 
  <a onclick="history.back()" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white">Back</a> 
  <?php if(!isset($_SESSION))
            session_start(); if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>
                <a href="../action/do-logout.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Logout </i></a>
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
         <!--Ottieni le info dell'utente selezionato dall'url-->
        <?php
          include "../../db/db_conn.php"; 
 
                     $url='http://';
                     $url.=$_SERVER['HTTP_HOST'];
                     $url.=$_SERVER['REQUEST_URI'];          
                     
                    $parts= parse_url($url);
                    parse_str($parts['query'],$params);
                   
                    $user_name =$params['user_name'];
                     
                     
                    $id=  $params['id'];
      
                    $sql = "SELECT * FROM favourites WHERE user_id = $id" ;
                    $result = pg_query($conn, $sql);
                    $movies_fav = array();
                
                    // Verifica se ci sono risultati nella query
                    if (pg_num_rows($result) > 0) {
                        $rows = pg_fetch_all($result);
                        
                        // Itera sui risultati per ottenere gli ID dei film preferiti
                        foreach ($rows as $row) {
                            $movies_fav[]=intval($row['movie_id']);
                        }
                    }
           
          ?>
         <script>
           //Variabile globale javascript dei gilm preferiti dell'utente selezionato
         const  FAVS = <?php echo json_encode($movies_fav);?>;
    </script>
  <p class="w3-center">
       
        <?php
         //ottieni l'immagine profilo dell'utente
               $user_name =$params['user_name'];
           
          $query = "SELECT * from image WHERE user_name='$user_name'";
          $result = pg_query($conn, $query);
           
          while ($data = pg_fetch_assoc($result)) {
          ?>
            <img class="profile_image w3-circle" alt="avatar" style="height:106px;width:106px" src="/uploads/<?php echo $data['filename']; ?>">
 
          <?php
          }
          ?>
         <!--Visualizza le altre info dell'utente-->
          </p>
          <h4 class="w3-center">Utente: <?php echo $user_name; ?>
         </h4> 
         <h4 class="w3-center">ID: <?php echo $id; ?>
         </h4> 
         <?php 
            $query = "SELECT * from users WHERE id='$id'";
            $result = pg_query($conn, $query);
            while ($data = pg_fetch_assoc($result)) {
              ?>
               <h4 class="w3-center">Email: <?php echo $data['email']; ?>
              </h4> 
              <h4 class="w3-center">Stato: <?php if($data['status']==0) echo "Disattivato"; else echo "Attivo" ?>
              </h4> 
               
              <?php
              }
              ?>
          
        </div>
      </div>
      <br>
    </div>
    <!-- Fine Colonna Sinistra -->
    
    
    <!-- Colonna Centrale -->
    <div class="w3-col m7">
      <div class="w3-container w3-card w3-white w3-round" style="margin-left:16px; max-height:800px;overflow:scroll">
        <h3>Film preferiti</h3>
        <hr class="w3-clear">
        <!-- Movie Container-->
        <div id="movie-container" style="background-color:white">
          <div class="movie-element"></div>
        </div>
        <!-- qui verranno visualizzati tutti i film preferiti -->
        <div id="list-container"></div>     
        <!-- Navigazione Pagina-->
      </div>
       
      <!--Recensioni-->
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <h3>Recensioni</h3><br>
        <hr class="w3-clear">
        <p>Visualizza qui le  recensioni  effetuate dall'utente</p>
          <div class="w3-row-padding" style="margin:0 -16px"> 
          <?php           
         
        if(!isset($_SESSION)) session_start();

        $name = $params['user_name'];            
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
                
            </p>                        
        </div>


<?php }
 ?>

        </div>
        <div class="w3-padding-16">
      
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

<script type="text/javascript" src="/script/user-profile.js"> 
 </script>

</body>
</html>
