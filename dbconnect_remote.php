<?php
$serverName = 'mysql13.000webhost.com';
$username = 'a5455109_LunchUX';
$password = 'LunchUX';
$dbname = 'a5455109_LunchUX';
$pdo = new PDO("mysql:host=".$serverName.";dbname=".$dbname, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>