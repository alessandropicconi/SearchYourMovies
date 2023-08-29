<?php
    // Includi il file di connessione al database
    include "../../db/db_conn.php";
    
    // Avvia la sessione
    session_start(); 

    // Ottieni l'ID dell'utente da cui rimuovere il ban  ottenuto dalla richiesta POST
    $id = $_POST['id'];
    
    $status=1;

     
    // Query per cambiare lo stato dell'utente
    $sql = "UPDATE users SET status=$status WHERE id=$id ";

    // Esegui la query sul database
    $result = pg_query($conn, $sql);
   
?>
