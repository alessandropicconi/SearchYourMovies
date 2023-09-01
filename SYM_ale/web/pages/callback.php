<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use PHPMailer\PHPMailer\PHPMailer;

include('config.php');
require_once "../../vendor/autoload.php"; 

// Verifica se è presente il parametro 'code' nell'URL
if (isset($_GET['code'])) {
    // Recupera il token di accesso da Google
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
    $google_client->setAccessToken($token['access_token']);

    // Recupera le informazioni sull'account Google
    $google_oauth = new Google\Service\Oauth2($google_client);
    $google_account_info = $google_oauth->userinfo->get();

    $email = $google_account_info->email;
    $name = $google_account_info->getName();

    // Verifica se l'utente esiste nel tuo sistema
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = pg_query($conn, $sql);

    if (pg_num_rows($result) === 1) {
        $row = pg_fetch_assoc($result);

        if ($row['status'] == 0) {
            header("Location: /web/pages/signin.php?error=Account disabled");
            exit();	
        } else {
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['is_admin'] = $row['is_admin'];
            $_SESSION['verification'] = $row['verification'];
            
            if ($_SESSION['is_admin'] == 1) {
                header("Location: /web/pages/admin.php");
            } else {
                header("Location: /profiloutente.php");
            }
            exit();
        }
    
    } else {
        $codeV = md5(rand()); 
        $status = 1; // Puoi impostare il valore di status come necessario
        $is_admin = 0; // Puoi impostare il valore di is_admin come necessario
        
        // Crea un nuovo utente nel database
        $insert_sql = "INSERT INTO users (email, user_name, pass, codeV, verification, is_admin, status) VALUES ('$email', '$name', '', '$codeV', true, $is_admin, $status)";
        $result = pg_query($conn, $insert_sql);
        
        if ($result) {
            // Ottieni l'ID dell'utente appena creato
            $inserted_user_id_query = "SELECT lastval()";
            $inserted_user_id_result = pg_query($conn, $inserted_user_id_query);
        
            if ($inserted_user_id_result) {
                $inserted_user_id_row = pg_fetch_row($inserted_user_id_result);
                $inserted_user_id = $inserted_user_id_row[0];
        
                // Imposta le variabili di sessione e reindirizza alla home page
                $_SESSION['user_name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $inserted_user_id;
                $_SESSION['status'] = $status;
                $_SESSION['is_admin'] = $is_admin;
        
                header("Location: /");
                exit();
            } else {
                // Gestisci l'errore nell'ottenere l'ID dell'utente appena creato
                echo "Error retrieving inserted user ID: " . pg_last_error($conn);
            }
        } else {
            // Gestisci l'errore dell'inserimento nel database
            echo "Error inserting user: " . pg_last_error($conn);
        }
    }
}

?>
