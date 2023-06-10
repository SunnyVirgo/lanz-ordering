<?php

include '../config/constant.php';
//destroy and redirect to log in page

session_destroy();

header('location:../index.php');
?>

