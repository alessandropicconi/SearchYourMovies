<?php 

use PHPMailer\PHPMailer\PHPMailer;
session_start(); 


include "../../db/db_conn.php";





//Load Composer's autoloader
require '../../vendor/autoload.php';

// Includiamo il file di gestione del login

$msg = "";
if (isset($_POST['submit'])) {
    $email = pg_escape_string($conn, $_POST['email']); 
    $CodeReset = pg_escape_string($conn, md5(rand())); 
    $result = pg_query($conn, "SELECT * FROM users WHERE email='{$email}'");
    if (pg_num_rows($result) > 0) {
        $query = pg_query($conn, "UPDATE users SET codeV='{$CodeReset}' WHERE email='{$email}'");
        if ($query) {
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
			$mail->Body = '<p> This is the Verification Link <b><a href="http://localhost/web/action/change-Password.php?Reset='.$CodeReset.'">http://localhost/web/action/change-Password.php?Reset='.$CodeReset.'</a></b></p>';

					
			$mail->send();
		
            
            $msg = "<div class='alert alert-info'>We've sent a verification code to your email address</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>This email: '{$email}' was not found</div>";
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/styles/forget.css" />
    <title>Sign in & Sign up Form</title>
    <style>
        .alert {
            padding: 1rem;
            border-radius: 5px;
            color: white;
            margin: 1rem 0;
            font-weight: 500;
            width: 65%;
        }

        .alert-success {
            background-color: #42ba96;
        }

        .alert-danger {
            background-color: #fc5555;
        }

        .alert-info {
            background-color: #2E9AFE;
        }

        .alert-warning {
            background-color: #ff9966;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup" style="left: 50%;z-index:99;">
                <form action="" method="POST" class="sign-in-form">
                    <h2 class="title">Forget Password</h2>
                    <?php echo $msg ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" placeholder="Email" />
                    </div>
                    <input type="submit" name="submit" value="Send" class="btn solid" />
                    <p class="social-text">Or Sign in with Google</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                    <a href="/" class="ca">SYM</a>
                </form>
            </div>
        </div>

        
    </div>

    <script src="app.js"></script>
</body>

</html>