<?php

use PHPMailer\PHPMailer\PHPMailer;

include('config.php');
require_once "../../vendor/autoload.php"; 

echo $_GET['code'];
// ...

if (isset($_GET['code'])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
    $google_client->setAccessToken($token['access_token']);

    $google_oauth = new Google\Service\Oauth2($google_client);
    $google_account_info = $google_oauth->userinfo->get();

    $email = $google_account_info->email;
    $name = $google_account_info->getName();

    // Verifica se l'utente esiste nel tuo sistema
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = pg_query($conn, $sql);

    if (pg_num_rows($result) === 1) {
        // L'utente esiste nel database, esegui l'accesso
        $row = pg_fetch_assoc($result);
    
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];
    
        header("Location: /");
        exit();
    } else {
        $codeV = md5(rand()); 

        // Crea un nuovo utente nel database
        $insert_sql = "INSERT INTO users (email, user_name, password, codeV, verification) VALUES ('$email', '$name', '', '$codeV', true)";
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
