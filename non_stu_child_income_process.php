<?php
session_start();

if(!isset($_SESSION['Incomes'])) {
	$_SESSION['Incomes'] = array();
}

$guid = $_SESSION['adults'][$_SESSION['AdultNumber']][0];

foreach ($_SESSION['Incomes'] as $key => $value) {
	if($value[0] == $guid) {
		unset($_SESSION['Incomes'][$key]);
	}
}

if((!isset($_POST['opt1-wageamt']))&&(!isset($_POST['opt2-wageamt']))&&(!isset($_POST['opt3-wageamt']))&&(!isset($_POST['opt4-wageamt']))) {
	$income = array();
	array_push($income, $guid, 0, 0, 0);
	array_push($_SESSION['Incomes'],$income);
}

for($i=0;$i<count($_POST['opt1-wageamt']);$i++) {
	$income = array();
	array_push($income, $guid, 1, $_POST['opt1-wageamt'][$i], $_POST['opt1-frequency'][$i]);
	array_push($_SESSION['Incomes'],$income);
}

for($i=0;$i<count($_POST['opt2-wageamt']);$i++) {
	$income = array();
	array_push($income, $guid, 2, $_POST['opt2-wageamt'][$i], $_POST['opt2-frequency'][$i]);
	array_push($_SESSION['Incomes'],$income);
}

for($i=0;$i<count($_POST['opt3-wageamt']);$i++) {
	$income = array();
	array_push($income, $guid, 3, $_POST['opt3-wageamt'][$i], $_POST['opt3-frequency'][$i]);
	array_push($_SESSION['Incomes'],$income);
}

for($i=0;$i<count($_POST['opt4-wageamt']);$i++) {
	$income = array();
	array_push($income, $guid, 4, $_POST['opt4-wageamt'][$i], $_POST['opt4-frequency'][$i]);
	array_push($_SESSION['Incomes'],$income);
}

if($_SESSION['AdultNumber']==(count($_SESSION['adults'])-1)){
	header("Location:hh_member_income.php");
	die();
} else {
	$_SESSION['AdultNumber']++;
	header("Location:non_stu_child_income.php");
	die();
}

?>