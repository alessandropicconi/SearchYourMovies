<?php
    // Includi il file di connessione al database
    include "../../db/db_conn.php";
    
    // Avvia la sessione
    session_start(); 

    // Ottieni l'ID del film dalla richiesta POST
    $movieId = $_POST['movieId'];
    
    // Ottieni l'ID dell'utente dalla sessione
    $userId = $_SESSION['id'];
    
    // Query per eliminare la riga corrispondente alla combinazione di user_id e movie_id dalla tabella 'favourites'
    $sql = "DELETE  FROM favourites WHERE user_id=$userId AND movie_id=$movieId";

    // Esegui la query sul database
    $result = pg_query($conn, $sql);
?>
