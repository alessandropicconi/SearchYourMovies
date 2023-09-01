<!DOCTYPE html>
<html>

<head>

    <?php include "web/fragment/user-data.php"; ?>
    
    <!-- website title  -->
    <title>SYM</title>

    <!-- link all'icona di fontawesome -->
    <script src="https://kit.fontawesome.com/8f0cceb3c2.js" crossorigin="anonymous"></script>

    <!-- style css link  -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="w3styling.css">
    <link rel="stylesheet" href="styles/myfav.css">

    <!--JQuery link-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

</head>

<?php 

if (isset($_POST['email_change'])){
        $email = isset( $_SESSION['email'] ) ? $_SESSION['email'] : '' ;
        $new_email = isset( $_POST['new-email'] ) ? $_POST['new-email'] : '' ;
        $pass = isset( $_POST['pass-email'] ) ? $_POST['pass-email'] : '' ;
        $pass = md5($pass);
        // Controllo

        $res = pg_query($conn,"SELECT * from users WHERE email='$email' AND pass='$pass'");
        if(pg_num_rows($res)===1){
            $sql = "UPDATE users
                    SET email = '$new_email'
                    WHERE email='$email' AND pass='$pass';";
            $result = pg_query($conn,$sql);
            $_SESSION['email'] = $new_email;
            echo '<p style="background-color:green;">Email modificata con successo</p>';
        }
        else{
            echo '<p style="background-color:red;">La password è errata, riprova</p>';

        };
    }

?>

<?php 

if (isset($_POST['pass_change'])){
        $name = isset( $_SESSION['user_name'] ) ? $_SESSION['user_name'] : '' ;
        $pass = isset( $_SESSION['pass'] ) ? $_SESSION['pass'] : '' ;
        $new_pass = isset( $_POST['new-pass'] ) ? $_POST['new-pass'] : '' ;
        $email = isset( $_SESSION['email'] ) ? $_SESSION['email'] : '' ;
        // Controllo se la password messa dall'utente è uguale alla vecchia pass
        $old_pass = isset( $_POST['old-pass'] ) ? $_POST['old-pass'] : '' ;
        $old_pass = md5($old_pass);
        $new_pass = md5($new_pass);
        $res = pg_query($conn,"SELECT * from users WHERE user_name='$name' AND pass='$old_pass'");
        if(pg_num_rows($res)===1){
            $sql = "UPDATE users
                SET pass = '$new_pass'
                WHERE user_name='$name' AND email='$email';";
                $result = pg_query($conn,$sql);
                $_SESSION['pass'] = $new_pass;
                echo '<p style="background-color:green;">Password modificata con successo</p>';
        }
        else{
            echo '<p style="background-color:red;">La password è errata, riprova</p>';

        };
        
        
    }

?>

<?php 

if (isset($_POST['nick_change'])){
        $name = isset( $_SESSION['user_name'] ) ? $_SESSION['user_name'] : '' ;
        $new_name = isset( $_POST['new-nick'] ) ? $_POST['new-nick'] : '' ;
        $pass = isset( $_POST['pass-nick'] ) ? $_POST['pass-nick'] : '' ;
        $pass = md5($pass);
        // Controllo
        $res = pg_query($conn,"SELECT * from users WHERE user_name='$name' AND pass='$pass'");
        if(pg_num_rows($res)===1){
            $sql = "UPDATE users
                SET user_name = '$new_name'
                WHERE user_name='$name' AND pass='$pass';";
            $result = pg_query($conn,$sql);
            $_SESSION['user_name'] = $new_name;
            echo '<p style="background-color:green;">Nome modificato con successo</p>';
        }
        else{
            echo '<p style="background-color:red;">La password è errata, riprova</p>';

        };
        
        
    }

?>







<body>


<!-- Navbar -->
<div style="z-index:1; width:100%">
 <div class="w3-bar w3-grey w3-left-align w3-large">
  <a href="/index.php" class="w3-bar-item w3-button w3-padding-large palette-netflix-bright-red w3-hover-white"><i class="fa fa-home w3-margin-right"></i> Home </a>
  <a href="/profiloutente.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Torna indietro </i></a>
  <?php 
  if(!isset($_SESSION))session_start(); 
  if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>
  <a href="web/action/do-logout.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Logout </i></a>
  <a href="web/action/delete-account.php" class="w3-bar-item w3-button w3-hide-small palette-netflix-bright-red w3-padding-large w3-hover-white" title="Account"> Delete </i></a>
  <?php } else { ?>
            <?php } ?>
 </div>
</div>


<!-- Contenitore Pagina Centrale, diviso in COLONNA SX e COLONNA CENTRALE -->
<div class="w3-container" style="margin-top: 40px;">    
    <div class="row">
        <div class="w3-container w3-card w3-white w3-round" style="text-align:center;margin:auto;max-width:400px">
            <br>
            <h1>I tuoi dati</h1>
            <br>
        </div>
        <br>
        <br>
        <div class="col" style="display:flex;justify-content:center">
            <div class="w3-container w3-card w3-white w3-round w3-margin">
                <br>
                <h4>Nickname: <?php echo $_SESSION['user_name'] ?></h4><br>

                <?php 
                $name = $_SESSION['user_name'];
                $sql = "SELECT * FROM users WHERE pass = '' AND user_name = '$name'";
                $result = pg_query($conn,$sql);
                if(pg_num_rows($result)==0){
                    ?>
                    <button type="button" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;" onclick="$('#nick-form').toggle()"> Cambia Nickname </button>
                    <form id='nick-form' method="post" style="display: none;">
                        <textarea name="new-nick" style="resize: none; border-radius:10px;"></textarea>
                        <label for="new-pass">Inserisci la Password:</label>
                        <textarea style="resize: none; border-radius:10px;" name="pass-nick"></textarea>
                        <button type="submit" name="nick_change" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;"> Cambia Nickname </button>
                    </form>
                <?php
                } else { 
                    ?>
                <?php
                }; ?>




            
                </div>
            <div class="w3-container w3-card w3-white w3-round w3-margin" >
                <br>
                <h4>Immagine Profilo</h4><br>
                <p class="w3-center">
                
                <?php
                include "../SYM_ale/db/db_conn.php";

                $user_name = $_SESSION['user_name'];
                $query = "SELECT * from image WHERE user_name='$user_name'";
                $result = pg_query($conn, $query);
 
                while ($data = pg_fetch_assoc($result)) {
                ?>
                <img class="profile_image w3-circle" alt="avatar" style="height:106px;width:106px" src="/uploads/<?php echo $data['filename']; ?>">
 
                <?php
                }
                ?>
                </p>
                <form action="/web/action/upload.php" method="post" id="cambia-immagine" enctype="multipart/form-data">
                    <label for="img">Cambia la tua immagine:</label>
                    <input type="file" id="fileToUpload" name="uploadfile" accept="image/*" style="margin:16px">
                    <button type="submit" name="upload" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;margin-top:16px"> Cambia Immagine </button>
                </form>
            </div>
            <div class="w3-container w3-round" >
                <div class="w3-container w3-card w3-white w3-round w3-margin">
                    <br>
                    <h4>Email: <?php echo $_SESSION['email']; ?></h4><br>

<?php 
                $name = $_SESSION['user_name'];
                $sql = "SELECT * FROM users WHERE pass = '' AND user_name = '$name'";
                $result = pg_query($conn,$sql);
                if(pg_num_rows($result)==0){
?>

                    <button type="button" name="email_change" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;" onclick="$('#email-form').toggle()"> Cambia Email </button>
                    <form id='email-form' method="post" style="display: none;">
                        <label for="new-email">Nuova Email:</label>
                        <textarea name="new-email" style="resize: none; border-radius:10px;"></textarea>
                        <label for="pass-email">Inserisci la Password:</label>
                        <textarea style="resize: none; border-radius:10px;" name="pass-email"></textarea>
                        <button type="submit" name="email_change" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;"> Cambia Email </button>
                    </form>
<?php
                } else { 
?>
<?php
                }; 
?>
           
                </div>
                
<?php 
                $name = $_SESSION['user_name'];
                $sql = "SELECT * FROM users WHERE pass = '' AND user_name = '$name'";
                $result = pg_query($conn,$sql);
                if(pg_num_rows($result)==0){
?>
                    <div class="w3-container w3-card w3-white w3-round w3-margin">
                    <br>
                    <h4>Password</h4><br>
                    <button type="button" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;" onclick="$('#pass-form').toggle()"> Cambia Password </button>
                    <form id='pass-form' name="new-pass" method="post" style="display: none;">
                        <label for="old-pass">Vecchia Password:</label>
                        <textarea style="resize: none; border-radius:10px;" name="old-pass"></textarea>
                        <br>
                        <label for="new-pass">Nuova Password:</label>
                        <textarea style="resize: none; border-radius:10px;" name="new-pass"></textarea>
                        <button type="submit" name="pass_change" class="w3-button palette-netflix-bright-red" style="margin-bottom: 16px;"> Cambia Password </button>
                    </form>
<?php
                } else { 

?>
<?php
                }; 
?>
       
                </div>   
            </div>     
        </div>
    </div>
</div>
<!-- End Page Container -->

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- Footers -->
<footer class="w3-container palette-netflix-bright-red w3-padding-16" style="width: 100%;">
  <h5>SYM</h5>
</footer>
<footer class="w3-container w3-grey" style="width: 100%;">
  <p>Natalia Mucha, Simone Parrella, Alessandro Picconi</a></p>
</footer>

<!-- Il codice JavaScript per la pagina principale è collegato qui -->

<script type="text/javascript" src="script/script.js"></script>

</body>
</html>
