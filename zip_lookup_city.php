<?php
include('dbconnect.php');
$stmt1 = $pdo->prepare("SELECT City FROM Zip_Code WHERE Zip_Code = (?)");
$stmt1->execute(array($_GET['zip']));
$rows = $stmt1->fetchAll();
foreach($rows as $row){
	echo($row['City']);
}
?>