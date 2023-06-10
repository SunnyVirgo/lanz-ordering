<?php

session_start();

//create constant
define('SITEURL', 'http://localhost/lanz-ordering/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'lanz_pizza');

//execute query and save data
($conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD)) or
    die(mysqli_error());
($db_select = mysqli_select_db($conn, DB_NAME)) or die(mysqli_error());
?>
