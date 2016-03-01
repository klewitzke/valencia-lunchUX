<?php
session_start();
$_SESSION['ChildNumber'] = 0;
if(isset($_POST['save2'])){
	if($_POST['foster']==0 && $_POST['headstart']==0 && $_POST['homeless']==0) {
		$_SESSION['FASTRACK'] = 0;
	}
	$_SESSION['maxStep'] = 3;
	if($_POST['edit-in-progress']==1){
		$_SESSION['children'][$_POST['selected']][1] = strtoupper($_POST['fn']);
		$_SESSION['children'][$_POST['selected']][2] = strtoupper($_POST['mi']);
		$_SESSION['children'][$_POST['selected']][3] = strtoupper($_POST['ln']);
		$_SESSION['children'][$_POST['selected']][4] = $_POST['foster'];
		$_SESSION['children'][$_POST['selected']][5] = $_POST['headstart'];
		$_SESSION['children'][$_POST['selected']][6] = $_POST['homeless'];
		header("Location:add_student.php");
		die();
	} else {
		$guid = strtoupper(md5(uniqid(rand(), true)));
		$child = array();
		array_push($child,$guid,strtoupper($_POST['fn']),strtoupper($_POST['mi']),strtoupper($_POST['ln']),$_POST['foster'],$_POST['headstart'],$_POST['homeless']);
		array_push($_SESSION['children'],$child);
		header("Location:add_student.php");
		die();
	}
} elseif (isset($_POST['delete'])) {
	$guid = $_SESSION['children'][$_POST['selected']][0];
	foreach ($_SESSION['Incomes'] as $key => $value) {
		if($value[0] == $guid) {
			unset($_SESSION['Incomes'][$key]);
		}
	}
	unset($_SESSION['children'][$_POST['selected']]);
	header("Location:add_student.php");
	die();
} else {
	if($_SESSION['case'] == 1) {
		$_SESSION['FASTRACK'] = 1;
		header("Location:fastrack.php");
		die();
	} else {
		$qualified = 0;
		$_SESSION['ChildCount'] = count($_SESSION['children']);
		for($i=0;$i<$_SESSION['ChildCount'];$i++) {
			if(($_SESSION['children'][$i][4]==1)||($_SESSION['children'][$i][5]==1)||($_SESSION['children'][$i][6]==1)) {
				$qualified++;
			}
		}
		if($qualified==$_SESSION['ChildCount']) {
			$_SESSION['FASTRACK'] = 1;
			header("Location:fastrack.php");
			die();
		} else {
			$_SESSION['FASTRACK'] = 0;
			header("Location:add_hh_member.php");
			die();
		}
	}
}
?>