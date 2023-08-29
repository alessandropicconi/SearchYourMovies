<?php
    // Includi il file di connessione al database
    include "../../db/db_conn.php";
    
    // Avvia la sessione
    session_start();

    // Ottieni l'ID dell'utente dalla sessione
    $userId = $_SESSION['id'];
    
    // Query per eliminare tutte le righe con l'user_id corrispondente dalla tabella 'favourites'
    $sql = "DELETE  FROM favourites WHERE user_id=$userId";

    // Esegui la query sul database
    $result = pg_query($conn, $sql);
?>
