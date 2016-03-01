<?php
session_start();
if($_POST['opt-in']==0) {
	$_SESSION['ethnicity'] = 3;
	$_SESSION['race1'] = 0;
	$_SESSION['race2'] = 0;
	$_SESSION['race3'] = 0;
	$_SESSION['race4'] = 0;
	$_SESSION['race5'] = 0;
	header("Location:contact.php");
	die();
} else {
	header("Location:optional_1.php");
	die();
}
?>