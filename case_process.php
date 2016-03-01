<?php
session_start();
$_SESSION['case'] = $_POST['case'];
if($_POST['case']==1) {
	$_SESSION['casenum'] = $_POST['casenum'];
	$_SESSION['FASTRACK'] = 1;
} else {
	unset($_SESSION['casenum']);
	$_SESSION['FASTRACK'] = 0;	
}
$_SESSION['maxStep'] = 3;
header("Location:add_student.php");
die();
?>