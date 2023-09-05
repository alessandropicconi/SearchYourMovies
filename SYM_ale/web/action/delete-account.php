
<?php
session_start();
include "../../db/db_conn.php"; // Assicurati di includere il file di connessione al database

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $delete_sql = "DELETE FROM favourites WHERE user_id='$user_id'";
    $result = pg_query($conn, $delete_sql);

    // Esegue la query per eliminare l'account
    $delete_sql = "DELETE FROM users WHERE id='$user_id'";
    $result = pg_query($conn, $delete_sql);

    if ($result) {
        // Eliminazione avvenuta con successo, distruggi la sessione e reindirizza
        session_destroy();
        header("Location: /"); // Reindirizza alla home page o ad altra pagina di destinazione
        exit();
    } else {
        echo "Error deleting account: " . pg_last_error($conn);
    }
} else {
    echo "User not logged in.";
}
?>

