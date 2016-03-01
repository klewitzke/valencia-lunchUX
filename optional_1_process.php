<?php
session_start();

$_SESSION['ethnicity'] = $_POST['ethnicity'];
$_SESSION['race1'] = $_POST['race1'];
$_SESSION['race2'] = $_POST['race2'];
$_SESSION['race3'] = $_POST['race3'];
$_SESSION['race4'] = $_POST['race4'];
$_SESSION['race5'] = $_POST['race5'];

header("Location:contact.php");
die();

?>