<?php
session_start();
$_SESSION['EnteredHHsize'] = $_POST['numberhidden'];
$ActualHHsize = (count($_SESSION['children']) + count($_SESSION['adults']));
if($_SESSION['EnteredHHsize'] == $ActualHHsize) {
	header("Location:student_income.php");
	die();
} else {
	header("Location:hh_size_error.php");
	die();
}
?>