<?php
 
session_start();
 if (($_SESSION['is_admin']==0) ){
 header('location:/../../Error.php');
}
?>
<?php include "../fragment/admin-data.php"; ?>
    <!DOCTYPE html>
    <html>
    <head>
         
        <!-- titolo del sito web -->
        <title>Admin Page</title>
    
        <!-- link al file css per lo stile -->
       <!-- <link rel="stylesheet" href="/styles/myfav.css"> -->
      
       <!-- link all'icona fontawesome -->
        <script src="https://kit.fontawesome.com/8f0cceb3c2.js" crossorigin="anonymous"></script>    <!-- link a JQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="../../styles/style.css">
        <link rel="stylesheet" href="../../w3styling.css">
        <link rel="stylesheet" href="../../styles/myfav.css">
        <link rel="stylesheet" href="../../styles/scrollbar.css">
        
    </head>
    <body>
        <div style="background-color:black;"> 
        <div id="heading"  class="w3-bar w3-grey w3-left-align w3-large">
            <!--Pulasnti per le azioni di base-->
            <a href="/index.php" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white"><i class="fa fa-home w3-margin-right"></i> Home </a> 
            <a href="../../account_data.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Account </i></a>
            <h><?php if(!isset($_SESSION))
                session_start(); if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>
                    <a href="../action/do-logout.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Logout </i></a>
                <?php } else { ?>
                <?php } ?></h>
                </div>
                <div class="w3-container w3-content palette-netflix-black" style="max-width:1400px; margin-top: 80px;">    
  
  <div class="w3-row"  > 
    <div class="w3-col m3">
      <!-- Profilo -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">Salve, <?php echo $_SESSION['user_name']; ?>
         </h4> 
         <p class="w3-center">

         <?php
          include "../../db/db_conn.php"; 
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
     
     <!--Pulsanti per azioni admin -->
            <div id="btns">
                <button id="view-users"class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white"><a href="view-users.php">Utenti</a></button>
                <button id="view-reports" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white"onclick="mostra()"> Segnalazioni </button>
               
            </div>
         <!--Segnalazioni-->   
            <div class="w3-col m7">
      <div id="report-container" class="w3-container w3-card w3-white w3-round" style="margin-left:16px; max-height:800px;overflow:scroll">
      <h2> Visualizza le segnalazioni qui: </h2>
        <hr class="w3-clear">
            <div id="report-list" >
              <div class="report-element"></div>
      </div>     
    </div>
           
    <script type="text/javascript" >
        
        var container = $("#report-container");
     //Nascondi/mostra area segnalazioni  
        container.toggle();
   
     function mostra(){
         container.toggle();
         }  
     //Itera sulle segnalazioni da visualizzare
     function fetchReports(){
       REPORT_LIST.forEach(report =>addReportToPage(report));
     ;
    }
    ;
    //Aggiungi segnalazione corrente
    function addReportToPage(report){ 
 
     var reportBox=document.createElement("div");
     reportBox.setAttribute("style","background-color: grey; padding: 8px 16px; margin-bottom: 8px; width: 100%;display:flex;border-radius:10px");

     var Report=document.createElement("p");
     Report.setAttribute("style","padding: 16px; border-radius:10px");
     Report.append(report.user_name+":"+report.report);
        
     reportBox.append(Report);
               $('#report-list').append(reportBox);
  };

     fetchReports();
    </script> 
                   
</div>
    </body>
    </html>
    <?php 
     
   


