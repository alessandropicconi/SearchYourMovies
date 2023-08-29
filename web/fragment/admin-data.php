<?php
if(!isset($_SESSION)) session_start(); 

// Verifica se la sessione è attiva
if (isset($_SESSION['id']) ) {
    include(dirname(__FILE__)."/../../db/db_conn.php");
 
    $sql = "SELECT * FROM users ";
    $result = pg_query($conn, $sql);
    $user_list = array();

    // Verifica se ci sono risultati nella query
    if (pg_num_rows($result) > 0) {
        $rows = pg_fetch_all($result);
        
        // Itera sui risultati per ottenere gli Utenti
        foreach ($rows as $row) {
            $u=array("user"=>$row['user_name'],"id"=>$row['id'],"email"=>$row['email'],"is_admin"=>$row['is_admin'],"status"=>$row['status']);
            $user_list[] = $u;
        }
    }
    
    ?>
<?php
$sql = "SELECT * FROM  reports ";
    $result = pg_query($conn, $sql);
    $report_list = array();

    // Verifica se ci sono risultati nella query
    if (pg_num_rows($result) > 0) {
        $rows = pg_fetch_all($result);
        
        // Itera sui risultati per ottenere le segnalazioni
        foreach ($rows as $row) {
            $r=array("user_name"=>$row['user_name'], "report"=>$row['report']);
            $report_list[]= $r;
        }
    } ?>
    
    <script>
        
         //Variabile globale javascript per la lista degli utenti
        const USER_LIST = <?php echo json_encode($user_list);?>;
          //Variabile globale javascript per la lista delle segnalazioni
        const REPORT_LIST = <?php echo json_encode($report_list);?>;
    </script>
    
<?php } else { ?>
    <script>
    
    </script>
<?php } ?>
