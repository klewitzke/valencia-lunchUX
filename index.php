<?php
session_start();
$_SESSION['Index_Check'] = 1;
$_SESSION['ApplicationSubmitted'] = 0;
header("Location:certify.php");
?>