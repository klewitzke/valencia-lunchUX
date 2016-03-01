<?php
session_start();
if (isset($_POST['EditChild'])) {
	$id = $_POST['selected'];
	header("Location:add_student.php?editId=".$id);
	die();
} elseif (isset($_POST['EditAdult'])) {
	$id = $_POST['selected'];
	header("Location:add_hh_member.php?editId=".$id);
	die();
} else {
	$_SESSION['fullname'] = $_POST['fullname'];
	$_SESSION['last4ssn'] = substr($_POST['last4ssn'],7,4);
	header("Location:process_application.php");
	die();
}
?>