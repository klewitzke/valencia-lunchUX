<html>
<head>
<title>Application for Free and Reduced Price School Meals</title>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload="window.print()">
<div id="main-container">
<div id="main">
<h2>National School Lunch Program<br />Application Confirmation</h2>
<?php
session_start();
$longApp_ID = str_pad($_SESSION['App_ID'],12,'0',STR_PAD_LEFT);
echo('<p>Your confirmation number is<br /><b>'.substr($longApp_ID,0,4).'-'.substr($longApp_ID,4,4).'-'.substr($longApp_ID,8,4).'</b></p>');
echo('<p>This application was submitted '.date('m/d/Y').' by<br /><b>'.$_SESSION['fullname'].'</b></p><p>Please contact your school directly<br />for application status.</p>');
echo('<button class="cancel" style="max-width:250px;font-size:18px;" onClick="window.close()"><i class="fa fa-times"></i> Close</button>');
?>
</body>
</html>