<?php
    // Includi il file di connessione al database
    include "../../db/db_conn.php";
    
    // Avvia la sessione
    session_start(); 

    // Ottieni l'ID dell' utente dalla richiesta POST
    $id = $_POST['id'];
    
    //Cambia lo stato per disattivare l'account
    $status=0;

     
    // Query per aggiornare lo stato dell'utente
    $sql = "UPDATE users SET status=$status WHERE id=$id ";

    // Se l'utente è loggato fai il logout ---DA TESTARE
    $result = pg_query($conn, $sql);
    if($id==$_SESSION['id'] && (isset($_SESSION['id'])) ){
      session_destroy();
       header('Location: index.php');
       exit();
    }
?>
