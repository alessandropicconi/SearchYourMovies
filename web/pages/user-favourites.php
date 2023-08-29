<!DOCTYPE html>
<html>
<head>
    
    <!-- titolo del sito web -->
    <title>Favourite Movies</title>
    <!-- link al file css per lo stile -->
    <link rel="stylesheet" href="/styles/myfav.css">
    <!-- link all'icona fontawesome -->
    <script src="https://kit.fontawesome.com/8f0cceb3c2.js" crossorigin="anonymous"></script>    <!-- link a JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include "../fragment/user-data.php"; ?>
</head>
<body>
    <!-- questa è la parte dell'intestazione -->
    <div id="heading">
        <!-- questo è il pulsante di ritorno alla pagina principale -->
        <button id="home"><a href="/"><i class="fas fa-chevron-left"></i></a></button>
        <!-- titolo del sito web con icona del cuore -->
        <span> Favourite<i class="fas fa-heart"></i></span>
        <!-- pulsante per cancellare tutti i film preferiti -->
        <div id="btns">
            <button id="clear-whole-list">Clear All</button>
        </div>
    </div>
    <!-- qui verranno visualizzati tutti i film preferiti -->
    <div id="list-container"></div>
     <!-- viene qui collegato il file JavaScript per la pagina dei preferiti -->
    <script src="/script/myfav.js"></script>
</body>
</html>