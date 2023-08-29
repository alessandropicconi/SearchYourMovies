<?php
    // Includi il file di connessione al database
    include "../../db/db_conn.php";
    
    // Avvia la sessione
    session_start(); 

    // Ottieni l'ID dell'utente dalla richiesta POST
    $id = $_POST['id'];

    $sql = "DELETE FROM favourites WHERE user_id=$id";

    // Esegui la query sul database
    $result = pg_query($conn, $sql);

    // Query per eliminare la riga corrispondente all'utente 
    $sql = "DELETE FROM users WHERE id=$id";

    // Esegui la query sul database
    $result = pg_query($conn, $sql);

    echo "<p style='background-color:green'> Utente Rimosso </p>"
?>
