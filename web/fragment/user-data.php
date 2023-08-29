<?php
session_start();

// Verifica se la sessione è attiva
if (isset($_SESSION['id'])) {
    include(dirname(__FILE__)."/../../db/db_conn.php");
    
    // Query per selezionare i preferiti dell'utente dalla tabella 'favourites'
    $sql = "SELECT * FROM favourites WHERE user_id = " . $_SESSION['id'];
    $result = pg_query($conn, $sql);
    $movies_fav = array();

    // Verifica se ci sono risultati nella query
    if (pg_num_rows($result) > 0) {
        $rows = pg_fetch_all($result);
        
        // Itera sui risultati per ottenere gli ID dei film preferiti
        foreach ($rows as $row) {
            $movies_fav[] = intval($row['movie_id']);
        }
    }

    ?>
    <script>
        // Imposta l'ID dell'utente corrente come variabile JavaScript
        const CURRENT_USER_ID = <?php echo $_SESSION['id'] ?>;
        
        // Converte l'array dei film preferiti in formato JSON per utilizzarlo in JavaScript
        const USER_FAVOURITES = <?php echo json_encode($movies_fav); ?>;
    </script>
<?php } else { ?>
    <script>
        // Se l'utente non è loggato, l'ID dell'utente corrente è impostato come null
        CURRENT_USER_ID = null;
    </script>
<?php } ?>
