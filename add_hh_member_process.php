<?php
session_start();
$_SESSION['AdultNumber'] = 0;
if(isset($_POST['save2'])){
	$_SESSION['maxStep'] = 4;
	if($_POST['edit-in-progress']==1){
		$_SESSION['adults'][$_POST['selected']][1] = strtoupper($_POST['fn']);
		$_SESSION['adults'][$_POST['selected']][2] = strtoupper($_POST['mi']);
		$_SESSION['adults'][$_POST['selected']][3] = strtoupper($_POST['ln']);
		$_SESSION['adults'][$_POST['selected']][4] = $_POST['adult'];
		header("Location:add_hh_member.php");
		die();
	} else {
		$guid = strtoupper(md5(uniqid(rand(), true)));
		$adult = array();
		array_push($adult,$guid,strtoupper($_POST['fn']),strtoupper($_POST['mi']),strtoupper($_POST['ln']),$_POST['adult']);
		array_push($_SESSION['adults'],$adult);
		header("Location:add_hh_member.php");
		die();
	}
} elseif (isset($_POST['delete'])) {
	$guid = $_SESSION['adults'][$_POST['selected']][0];
	foreach ($_SESSION['Incomes'] as $key => $value) {
		if($value[0] == $guid) {
			unset($_SESSION['Incomes'][$key]);
		}
	}
	unset($_SESSION['adults'][$_POST['selected']]);
	header("Location:add_hh_member.php");
	die();
} else {
	header("Location:hh_size.php");
	die();
}
?>