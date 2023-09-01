<?php

$conn = pg_connect("host=localhost port=5432 dbname=my_database user=postgres password=10011998");

if (!$conn) {
	echo "Connection failed!";
}

?>
