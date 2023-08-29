<?php
session_start();
include "../../db/db_conn.php";


$msg = "";
$error = "";
if (isset($_GET['Reset'])) {
    if (pg_num_rows(pg_query($conn, "SELECT * FROM users WHERE codeV='{$_GET['Reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $Pass = pg_escape_string($conn, $_POST['password']);
            $Confirme_Pass = pg_escape_string($conn, $_POST['re_password']);
            if ($Pass === $Confirme_Pass) {
                $sql = "UPDATE users SET Password ='" . md5($Pass) . "' WHERE codeV='{$_GET['Reset']}'";
                $result = pg_query($conn, $sql);
                if ($result) {
                    header("Location: /web/pages/welcome.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
                $error = 'style="border:1px Solid red;box-shadow:0px 1px 11px 0px red"';
            }
        }
    }
} else {
    header("Location: do-forget.php");
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
        /* ... Lo stile rimane invariato ... */
    </style>
</head>

<body>
    <div class="container sign-up-mode">
        <div class="forms-container">
            <div class="signin-signup" style="left: 50%;z-index:99;">
                <form method="POST" class="sign-up-form">
                    <h2 class="title">Change Password</h2>
                    <?php echo $msg ?>

                    <div class="input-field" <?php echo $error ?>>
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <div class="input-field" <?php echo $error ?>>
                        <i class="fas fa-lock"></i>
                        <input type="password" name="re_password" placeholder="Confirm Password" />
                    </div>
                    <input type="submit" name="submit" class="btn" value="Save" />
                    <p class="social-text">Or Sign up with Google</p>
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
</body>

</html>
