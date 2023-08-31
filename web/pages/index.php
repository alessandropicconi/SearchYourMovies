<?php
include('config.php');
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.jpg" /></a>';
}
?>
<html>

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>PHP Login using Google Account</title>
   <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport' />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

</head>

<body>
   <div class="container">
      <div class="panel panel-default">
         <?php
         if ($login_button == '') {
            echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
            echo '<img src="' . $_SESSION["user_image"] . '" class="img-responsive img-circle img-thumbnail" />';
            echo '<h3><b>Name :</b> ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</h3>';
            echo '<h3><b>Email :</b> ' . $_SESSION['user_email_address'] . '</h3>';
         } else {
            echo '<div align="center">' . $login_button . '</div>';
         }
         ?>
      </div>
   </div>
</body>

</html>