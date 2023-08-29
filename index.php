<!DOCTYPE html>
<html>

<head>
    
    <!-- website title  -->
    <title>SYM</title>
    <!-- fontawesome (è una libreria di icone) icon link -->
    <!-- link all'icona di fontawesome -->
    <script src="https://kit.fontawesome.com/8f0cceb3c2.js" crossorigin="anonymous"></script>
    <!-- style css link  -->
    <link rel="stylesheet" href="styles/style.css">
    <!--JQuery link-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php include "web/fragment/user-data.php"; ?>
</head>

<body>
<!-- Questo è il div (contenitore) principale del sito web  -->
<div id="main">
    <!-- Questa è la sezione dell'intestazione -->
    <div id="header">
        <!-- Questo è il logo del sito web che si presenta sotto forma di immaginee  -->
        <div id="logodiv" style="margin: 40px">
            <a href="/"><img id="logoimg" src="./images/melogo.jpeg" alt="MoviesExpo"></a>
        </div>

        <!-- Questa è la sezione di ricerca  -->
        <div id="search-bar">
            <div class="search-content">
                <div id="search-area">
                    <!-- Questa è l'area di input per la ricerca del film -->
                    <input type="text" name="searchMovie" id="searchMovie"
                           placeholder="search your movie here" autocomplete="off">
                    <i class="search-icon fas fa-search"></i>
                </div>
                <!--Qui verranno visualizzati i risultati -->
                <div class="results">
                    <ul>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Questa è la sezione di destra dell'intestazione dove
            vengono visualizzati i film preferiti -->
        <div id="right-section">
            <?php   if(!isset($_SESSION)) session_start();
                    if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['is_admin'])) { ?>

                    


                    <h1>
                        Hi, <?php echo $_SESSION['user_name'] ?>
                    </h1>

                    <button class="logoutbutton" id="logout-button">
                    <?php if($_SESSION['is_admin']==0) {?><?php ;}
                  elseif($_SESSION['is_admin']==1) {?> <a href="/web/pages/admin.php">Admin Page</a> <?php ;}?>
                    </button>


                
                    <button class="logoutbutton" id="logout-button">
                        <a href="profiloutente.php">Profilo</a>
                    </button>

                    <button class="logoutbutton" id="logout-button">
                        <a href="web/action/do-logout.php">Logout</a>
                    </button>

                    <div class="dropdown">
                        <button class="dropdown-button">Menu</button>
                        <div class="dropdown-content">
                            <a href="/web/pages/user-favourites.php">Favourites</a>
                            <a href="web/action/do-logout.php">Logout</a>
                        </div>
                    </div>

            <?php } 
                    else { 
            ?>
                <button class="logbutton" id="login-button">
                    <a href="web/pages/signin.php">Login</a>
                </button>
            <?php } ?>
        </div>
    </div>
    <!-- Questo è il contenitore dei film,
        qui vengono visualizzati tutti i film -->
    <div id="movie-container">
        <div class="movie-element"></div>
    </div>
</div>

<!-- Questi sono i pulsanti successivo e precedente
    per passare alla pagina successiva"  -->
<div class="page-navigation">
    <button id="prev-page">Prev</button>
    <button id="next-page">Next</button>
</div>

<!-- Il codice JavaScript per la pagina principale è collegato qui -->
<script type="text/javascript" src="script/script.js"></script>

</body>
</html>
