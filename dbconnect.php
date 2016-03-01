<?php
$serverName = 'LEWITZKE\sqlexpress'; //serverName\instanceName
$username = 'dbconnect';
$password = 'dbconnect';
$dbname = 'ResSys';
$pdo = new PDO("sqlsrv:Server=".$serverName.";Database=".$dbname, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>