<?php   

error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
session_start();

// Includiamo il file di connessione al database
include "../../db/db_conn.php";

// Includiamo il file di gestione del login
include "../pages/signin.php";

require_once "../../vendor/autoload.php";


// Funzione per validare l'input
function valid_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// Controlliamo se tutti i campi sono stati inseriti
if (isset($_POST['uname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['re_password'])) {

	// Validiamo l'input
	$uname = valid_input($_POST['uname']);
	$pass = valid_input($_POST['password']);
	$re_pass = valid_input($_POST['re_password']);
	$email = valid_input($_POST['email']);
	

	// Creiamo una stringa contenente i dati dell'utente
	$user_data = 'uname='. $uname. '&email='. $email;

	// Controlliamo se l'username è vuoto
	if (empty($uname)) {
		$error_msg = "Userame is required";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	// Controlliamo se la password è vuota
	} else if(empty($pass)){
		$error_msg = "Password is required";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	// Controlliamo se la conferma password è vuota
	} else if(empty($re_pass)){
		$error_msg = "Confirm assword is required";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	// Controlliamo se l'email è vuota	
	} else if(empty($email)){
		$error_msg = "Email is required";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	// Controlliamo se la password e la conferma password corrispondono 
	} else if($pass != $re_pass){
		$error_msg = "The confirmation password  does not match";
		header("Location: /web/pages/signup.php?error=$error_msg&$user_data");
		exit();
	} else {
		// Se tutti i campi sono stati inseriti, hashiamo la password
		$pass = md5($pass);
		$code = md5(rand());

		// Controlliamo se l'email o l'username sono già presenti nel database
		$sql = "SELECT * FROM users WHERE email='$email' OR user_name='$uname'";
		$result = pg_query($conn, $sql);

		if (pg_num_rows($result) > 0) {
			// Se l'username o email sono già presenti, mostrare un errore
			header("Location: /web/pages/signup.php?error=The username is taken try another&$user_data");
	        exit();
		} else {
			// Se l'username e l'email non sono presenti, inseriamo i dati dell'utente nel database
			$status=1;
			$is_admin=0;
	        $sql2 = "INSERT INTO users(user_name, email, pass, codeV,status,is_admin) VALUES('$uname', '$email', '$pass','$code','$status','$is_admin')";
			$result2 = pg_query($conn, $sql2);
			if ($result2) {

				$mail = new PHPMailer(true);
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'labsym2023@gmail.com'; // YOUR gmail email
				$mail->Password = 'tqpsdrcadulncjgm'; // YOUR gmail password
				
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;
				
					
				// Sender and recipient settings
				$mail->setFrom('labsym2023@gmail.com');
				$mail->FromName = "SYM";
				$mail->addAddress($email, $uname);
				// Setting the email content
					
				$mail->Subject = "Welcome to SYM";
				$mail->Body = '<p> This is the Verification Link <b><a href="http://localhost/web/action/?Verification='.$code.'">http://localhost/web/action/?Verification='.$code.'</a></b></p>';

					
				//$mail->send();
				echo "Email message sent.";
				if (!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					header("Location: /web/pages/signup.php?success=We've send a verification code on Your email Address");
					exit();
				}
           }else {
			//altrimenti mostrami un messaggio d'errore
			    header("Location: /web/pages/signup.php?error=Something was Wrong&$user_data");
		        exit();
           }
		}
	}
//se tutti i campi non sono stati inseriti,ritorna alla pagina di signup
}else{
	header("Location: /web/pages/signup.php");
	exit();
}
?>