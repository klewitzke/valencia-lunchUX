<?php
session_start();
$_SESSION['Index_Check'] = 1;
header("Location:certify.php");
?>