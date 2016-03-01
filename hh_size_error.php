<?php include('header.php');
$currStep = 4;
if($_SESSION['maxStep'] < 4) {
	$_SESSION['maxStep'] = 4;
}
?>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<b>You indicated a total of 
<?php
if($_SESSION['EnteredHHsize']==1) {
	echo('1 person');
} else {
	echo($_SESSION['EnteredHHsize'].' people');
}

echo(' in your household, but previously entered ');

if(count($_SESSION['children'])==1) {
	echo('1 child');
} else {
	echo(count($_SESSION['children']).' children');
}

echo(' and ');

if(count($_SESSION['adults'])==1) {
	echo('1 adult');
} else {
	echo(count($_SESSION['adults']).' adults');
}
?>
<br /><br />We're taking you back to review the application</b><br />
</div>
<button class="nav-prev" onClick="parent.location='add_student.php'; return false;" ><i class="fa fa-undo"></i><br />Go Back</button>
<?php include('footer.php'); ?>
</body>
</html>