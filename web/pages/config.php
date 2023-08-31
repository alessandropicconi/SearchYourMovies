<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once '../../vendor/autoload.php';



//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId("11015160457-7k1n0s58hm73vte2hb6k0in29mdla7h6.apps.googleusercontent.com");

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret("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");

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost:3000/web/pages/callback.php');
//accendere APACHE e 3000 per ale
// problema: sono loggato ma non appaiono i pulsanti per accedere al profilo


//
$google_client->addScope('email');

$google_client->addScope('profile');


$smtp_host = "smtp.gmail.com";
$smtp_username = "labsym2023@gmail.com";
$smtp_password = "tqpsdrcadulncjgm";
$smtp_from_address = "labsym2023@gmail.com";
$smtp_from_address_name="SYM";


//start session on web page
session_start();
include "../../db/db_conn.php";

?>
