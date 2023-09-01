<?php
 
session_start();
 if (($_SESSION['is_admin']==0) ){
 header('location:/../../Error.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nuovo utente</title>
    <!-- Include a CSS file with common styles for login and registration -->
    <link rel="stylesheet" type="text/css" href="/styles/logsign.css">
     <!-- Link to the Bootstrap CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
     crossorigin="anonymous">
</head>
<body>
     <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
     <!-- Symbol definitions for icons -->
     </svg>
     
     <!-- Registration form, data will be sent to the server using the POST method -->
     <form action="/web/action/do-register-check.php" method="post">
        <h2 class="text-center">SIGN UP</h2>
        <?php 
            // Display an error message if present in the querystring
            if (isset($_GET['error'])) { 
            ?>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                <!-- Icon for warning -->
                <div>
                    <p><?php echo $_GET['error']; ?></p>
                </div>
                </div>
            <?php 
           }
        ?>

        <?php 
            // Display a success message if present in the querystring
            if (isset($_GET['success'])) { 
            ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <!-- Icon for success -->
                    <div>
                        <?php echo $_GET['success']; ?>
                    </div>
                </div>
            <?php 
           } 
        ?>

        <label for="email" class="form-label">Email</label>
        <?php 
            // Display email input if email is present in the querystring
            if (isset($_GET['email'])) { 
        ?>
            <input type="email" 
                  name="email" 
                  placeholder="Email"
                  value="<?php echo $_GET['email']; ?>"><br>
        <?php 
            } else { 
                // Otherwise, leave the input field empty
        ?>
            <input type="email" 
                  name="email" 
                  placeholder="Email"><br>
        <?php 
            } 
        ?>

        <label>Nome Utente</label>
        <?php 
            // Display username input if username is present in the querystring
            if (isset($_GET['uname'])) { 
        ?>
            <input type="text" 
                  name="uname" 
                  placeholder="User Name"
                  value="<?php echo $_GET['uname']; ?>"><br>
        <?php 
            } else { 
                // Otherwise, leave the input field empty
        ?>
            <input type="text" 
                  name="uname" 
                  placeholder="User Name"><br>
        <?php 
            } 
        ?>

          
        <label>Password</label>
        <input type="password" 
             name="password" 
             placeholder="Password"><br>

        <label>Confirma Password</label>
        <input type="password" 
             name="re_password" 
             placeholder="Confirm Password"><br>

        <button type="submit">Aggiungi utente</button>
        <!-- Pulsante per tornare alla pagina precedente -->
        <a  onclick="window.location.href='/web/pages/view-users.php'" class="ca">Torna indietro</a>

     </form>

</body>
</html>
