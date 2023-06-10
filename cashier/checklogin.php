<?php

if (!isset($_SESSION['cash'])) {
    header('location:../index.php?log-in=1');
}

?>
