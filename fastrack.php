<?php
$_SESSION['FASTRACK_displayed'] = 1;
include('header.php');


$currStep = 3;
if($_SESSION['maxStep'] < 3) {
	$_SESSION['maxStep'] = 3;
}
?>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main" style="text-align:left;">
<p><i class="fa fa-star" style="color:#eac117;"></i> Based on the information you provided, you are eligible to <span style="color:red;font-weight:bold;font-style:italic;">FAST TRACK</span> to the end of the application</p><p><i class="fa fa-star" style="color:#eac117;"></i> Your children will still be eligible for free or reduced price school meals (subject to verification)</p>
</div>
<button tabindex="2" type="submit" id="next" class="nav-next" onClick="parent.location='optional.php'; return false;"><i class="fa fa-arrow-right"></i><br />Continue</button>
<?php include('footer.php'); ?>
</body>
</html>