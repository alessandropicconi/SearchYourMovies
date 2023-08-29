<?php
 
session_start();
 if (($_SESSION['is_admin']==0) ){
 header('location:/../../Error.php');
}
?>
    <!DOCTYPE html>
    <html>
    
   
    <head>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="w3styling.css">
    <link rel="stylesheet" href="styles/myfav.css">
    <link rel="stylesheet" href="styles/scrollbar.css">
    <?php

 

 include "../fragment/admin-data.php";   
    ?>
    </head>
    <html>
    <body>
        <div  >
   <!--Pulsanti per azioni baseS-->
    <a href="/index.php" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white"><i class="fa fa-home w3-margin-right"></i> Home </a> 
        <h><?php if(!isset($_SESSION))
                session_start(); if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>
                    <a href="../action/do-logout.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Logout </i></a>
                <?php } else { ?>
                <?php } ?></h>
                <a href="/web/pages/admin.php" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white"><i class="fa fa-home w3-margin-right"></i> Back </a> 

                 <!-- <div id="search-bar">
            <div class="search-content">
                <div id="search-area">
                    
                    <input type="text" name="searchUsers" id="searchUsers"
                           placeholder="search user here" autocomplete="off">
                     <i class="search-icon fas fa-search"></i> 
                </div>
                
            
            </div>
        </div> -->
        <hr>
    <div  >  
    <!--Pulsante per aggiungere l'utente-->       
    <button id="add" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white"><a href="register-add.php">Aggiungi Utente</a></button> 
    <!-- Crea una tabella dove mettere gli utenti-->
    <table id="tabs"   class="we-table-all w3-centered w3-bordered w3-striped">
        <tr  class="w3-blue">
         <th> User name </th>
         <th> ID </th>
         <th> Email </th>
         <th> Profilo </th>
         <th> Elimina </th>
         <th> Ban </th>
         
</tr>
</table>
                </div>
<script type="text/javascript" src="/script/view-users.js" >

  </script> 
  </div>
</body>
  </html>

