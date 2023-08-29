
<?php

 
$msg = "";

include "../../db/db_conn.php";
include "../fragment/user-data.php";
 
// If upload button is clicked ...
if (isset($_POST['upload'])) {
 
    $filename = $_FILES["uploadfile"]["name"];
    echo $filename;
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    echo $tempname;
    $folder = "../../uploads/" . $filename;
    echo $folder;
    $user = $_SESSION['user_name'];

    $sql = "DELETE FROM image WHERE user_name = '$user'";
    pg_query($conn,$sql);
 
    
 
    // Get all the submitted data from the form
    $sql = "INSERT INTO image (user_name,filename) VALUES ('$user','$filename')";
 
    // Execute query
    pg_query($conn, $sql);
 
    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image! </h3>";
        echo $user;
    }
}
?>