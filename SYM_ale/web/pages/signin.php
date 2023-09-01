<?php
include('config.php');
if(!isset($_SESSION['access_token']))
{
 //reate a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.jpg" /></a>';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<!-- Collegamento al file CSS per lo stile della pagina -->
	<link rel="stylesheet" type="text/css" href="/styles/logsign.css">
	<!-- Collegamento al file CSS per le icone di Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Collegamento al file CSS di Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
         crossorigin="anonymous">
</head>
<body>

    <!--definiamo elemento SVG da bootstrap-->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
     <symbol id="check-circle-fill" viewBox="0 0 16 16">
     <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
     </symbol>
     <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
     <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
     </symbol>
     </svg>
     <!-- Form per il login -->
     <form action="/web/action/do-login.php" method="post">
     	<h2>LOGIN</h2>
     	<!-- Mostra un messaggio di errore se la variabile $_GET['error'] è settata -->


     	<?php include "login-error.php"; ?>

     	 <!-- Input del nome utente -->
     	 <div class="form-group">
    		<i class="fa fa-user icon"></i>
			<input type="text" name="email" placeholder="Email" class="form-control mb-3">  		
        </div>
  
  	<!-- Input della password -->
	<div class="form-group">
		<i class="fa fa-lock icon"></i>
		<input type="password" name="password" placeholder="Password" class="form-control mb-3">	
    </div>

    <a href="/web/action/do-forget.php" class="ca forgot-password-link">Forgot Password?</a>

	<!-- Bottone per effettuare il login -->
    <button type="submit" id="login">Login</button>    
    <!-- Link per creare un nuovo account -->
	<a href="/web/pages/signup.php" class="ca">Create an account</a>
    <a href="/" class="ca">SYM</a>
    <p class="social-text">Or Sign up with Google</p>
    <div class="social-media">
        <a href="#" class="social-icon google-button">
            <?php echo $login_button; ?></a>
    </div>
</form>

    

</body>
</html>