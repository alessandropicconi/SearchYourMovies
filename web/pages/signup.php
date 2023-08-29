<!DOCTYPE html>
<html>
<head>
    <title>SIGN UP</title>
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
     <form action="/web/action/do-signup-check.php" method="post">
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

        <label>User Name</label>
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

        <label>Confirm Password</label>
        <input type="password" 
             name="re_password" 
             placeholder="Confirm Password"><br>

        <button type="submit">Sign Up</button>
        <!-- Link to the login page if the user already has an account -->
        <a href="/web/pages/signin.php" class="ca">Already have an account?</a>
        <a href="/" class="ca">SYM</a>

     </form>

</body>
</html>
