<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "../../db/db_conn.php";




$msg = "";
$Error_Pass = "";
if (isset($_GET['Verification'])) {
  $raquet = pg_query($conn, "SELECT * FROM users WHERE codeV='{$_GET['Verification']}'");
  if (pg_num_rows($raquet) > 0) {
    $query = pg_query($conn, "UPDATE users SET verification='true' WHERE codeV='{$_GET['Verification']}'");
    if ($query) {
      $rowv = pg_fetch_assoc($raquet);
      header("Location: /web/pages/welcome.php?id='{$rowv['id']}'");
    }else{
      header("Location: /web/pages/signin.php");
    }
  } else {
    header("Location: /web/pages/signin.php");
  }
}


?>