<?php
include('header.php');
$currStep = 8;
if($_SESSION['maxStep'] < 8) {
	$_SESSION['maxStep'] = 8;
}

include('dbconnect.php');

try {
	$pdo->beginTransaction();
	$stmt1 = $pdo->prepare("INSERT INTO Application (Date_Time, Full_Name, Last_4_SSN, Case_Num, Email, Phone, Addr_1, Addr_2, City, State, Zip_Code, Ethn, Race_1, Race_2, Race_3, Race_4, Race_5) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt1->bindParam(1, date('Y-m-d H:i:s'));
	$stmt1->bindParam(2, $_SESSION['fullname']);
	$stmt1->bindParam(3, $_SESSION['last4ssn']);
	$stmt1->bindParam(4, $_SESSION['casenum']);
	$stmt1->bindParam(5, $_SESSION['email']);
	$stmt1->bindParam(6, $_SESSION['phone']);
	$stmt1->bindParam(7, $_SESSION['addr1']);
	$stmt1->bindParam(8, $_SESSION['addr2']);
	$stmt1->bindParam(9, $_SESSION['city']);
	$stmt1->bindParam(10, $_SESSION['state']);
	$stmt1->bindParam(11, $_SESSION['zip']);
	$stmt1->bindParam(12, $_SESSION['ethnicity']);
	$stmt1->bindParam(13, $_SESSION['race1']);
	$stmt1->bindParam(14, $_SESSION['race2']);
	$stmt1->bindParam(15, $_SESSION['race3']);
	$stmt1->bindParam(16, $_SESSION['race4']);
	$stmt1->bindParam(17, $_SESSION['race5']);
	$stmt1->execute();
	$_SESSION['App_ID'] = $pdo->lastInsertId();

	$stmt2 = $pdo->prepare("INSERT INTO Person (PID, Type, App_ID, First_Name, MI, Last_Name) VALUES (?, 1, ?, ?, ?, ?)");
	$stmt3 = $pdo->prepare("INSERT INTO Student_Category (PID, Cat) VALUES (?, 1)");
	$stmt4 = $pdo->prepare("INSERT INTO Student_Category (PID, Cat) VALUES (?, 2)");
	$stmt5 = $pdo->prepare("INSERT INTO Student_Category (PID, Cat) VALUES (?, 3)");
	if(isset($_SESSION['children'])) {
		foreach ($_SESSION['children'] as $value) {
			$stmt2->bindParam(1, $value[0]);
			$stmt2->bindParam(2, $_SESSION['App_ID']);
			$stmt2->bindParam(3, $value[1]);
			$stmt2->bindParam(4, $value[2]);
			$stmt2->bindParam(5, $value[3]);
			$stmt2->execute();
			if($value[4]==1) {	//foster
				$stmt3->bindParam(1, $value[0]);
				$stmt3->execute();
			}
			if($value[5]==1) {	//head start
				$stmt4->bindParam(1, $value[0]);
				$stmt4->execute();
			}
			if($value[6]==1) {	//homeless, migrant, runaway
				$stmt5->bindParam(1, $value[0]);
				$stmt5->execute();	
			}
		}
	}
	if(isset($_SESSION['adults'])) {
		foreach ($_SESSION['adults'] as $value) {
			if($value[4]==1) {
				$stmt2 = $pdo->prepare("INSERT INTO Person VALUES (?, 2, ?, ?, ?, ?)");
			} else {
				$stmt2 = $pdo->prepare("INSERT INTO Person VALUES (?, 3, ?, ?, ?, ?)");
			}
			$stmt2->bindParam(1, $value[0]);
			$stmt2->bindParam(2, $_SESSION['App_ID']);
			$stmt2->bindParam(3, $value[1]);
			$stmt2->bindParam(4, $value[2]);
			$stmt2->bindParam(5, $value[3]);
			$stmt2->execute();
		}
	}
	$stmt6 = $pdo->prepare("INSERT INTO Income (PID, Cat, Amt, Freq) VALUES (?, ?, ?, ?)");
	if(isset($_SESSION['Incomes'])) {
		foreach ($_SESSION['Incomes'] as $value) {
			$stmt6->bindParam(1, $value[0]);
			$stmt6->bindParam(2, $value[1]);
			$stmt6->bindParam(3, $value[2]);
			$stmt6->bindParam(4, $value[3]);
			$stmt6->execute();
		}
	}
	$pdo->commit();
	$_SESSION['ApplicationSubmitted'] = 1;

} catch(PDOException $e) {
	$pdo->rollback();
	die($e->getMessage());
}
header("Location:confirmation.php");
die();
?>