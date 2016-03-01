<?php
session_start();
$_SESSION['zip'] = $_POST['zip'];
$_SESSION['addr1'] = strtoupper($_POST['addr1']);
$_SESSION['addr2'] = strtoupper($_POST['addr2']);
$_SESSION['city'] = strtoupper($_POST['city']);
if(isset($_POST['state'])) {
	$_SESSION['state'] = $_POST['state'];
} else {
	$_SESSION['state'] = $_POST['state-hidden'];
}
$_SESSION['phone'] = substr($_POST['phone'],1,3).substr($_POST['phone'],6,3).substr($_POST['phone'],10,4);
$_SESSION['email'] = $_POST['email'];
header("Location:signature.php");
?>