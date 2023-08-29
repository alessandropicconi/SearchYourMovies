<?php
    include "../../db/db_conn.php";
    session_start(); 

    $movieId = $_POST['movieId']; // COME
    $userId = $_SESSION['id'];


    $sql = "SELECT * FROM favourites WHERE user_id=".$userId." AND movie_id="."$movieId";
    $result = pg_query($conn, $sql);

    if (pg_num_rows($result) == 0) {
        $sqlInsert = "insert into favourites  (user_id, movie_id) values ($userId,$movieId)";
        pg_query($conn, $sqlInsert);
    }
?>