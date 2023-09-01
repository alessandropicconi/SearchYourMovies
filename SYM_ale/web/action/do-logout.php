<?php 
/*inizializza sessione */
session_start();
/*rimuovi tutte le variabili della sessione */
session_unset();
session_destroy();

/*reinderizza l'utente nella home page*/
header("Location: /");

?>