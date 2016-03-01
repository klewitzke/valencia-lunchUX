<?php
include('header.php');
$currStep = 5;
if($_SESSION['maxStep'] < 5) {
	$_SESSION['maxStep'] = 5;
}
?>
<script>
	$(function() {
		$( ".option" ).click(function() {
			$("#next").show();
			if ($(this).attr("id") == "yes") {
				$(this).addClass("selected");
				$("#no").removeClass("selected");
				$("#opt-in").val("1");
			} else if ($(this).attr("id") == "no") {
				$(this).addClass("selected");
				$("#yes").removeClass("selected");
				$("#opt-in").val("0");
			}
		});
	});
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<form action="optional_process.php" method="post">
<?php
echo('<input type="hidden" id="opt-in" name="opt-in" value="');
if(isset($_SESSION['ethnicity']) && ($_SESSION['race1']==1||$_SESSION['race2']==1||$_SESSION['race3']==1||$_SESSION['race4']==1||$_SESSION['race5']==1||$_SESSION['ethnicity']==1||$_SESSION['ethnicity']==2)) {
	echo('1');
} else {
	echo('0');
}
echo('" />');
echo('<p>We are required to ask for information about your children\'s ethnicity and race. We use this information to make sure we are fully serving our community.</p><p>Providing this information is <b><u>optional</u></b> and does not affect your children\'s eligibility for free or reduced price meals.</p><p><b>Would you like to provide information about your children\'s ethnicity and race?</p></b><button id="yes" class="option');
if(isset($_SESSION['ethnicity']) && ($_SESSION['race1']==1||$_SESSION['race2']==1||$_SESSION['race3']==1||$_SESSION['race4']==1||$_SESSION['race5']==1||$_SESSION['ethnicity']==1||$_SESSION['ethnicity']==2)) {
	echo(' selected');
}
echo('" onClick="return false;">Yes</button><button id="no" class="option');
if(isset($_SESSION['ethnicity']) && ($_SESSION['race1']==0 && $_SESSION['race2']==0 && $_SESSION['race3']==0 && $_SESSION['race4']==0 && $_SESSION['race5']==0 && $_SESSION['ethnicity']==3)) {
	echo(' selected');
}
echo('" onClick="return false;">No</button>');
echo('</div>');
echo('<button tabindex="5" class="nav-prev" onClick="parent.location=\'add_student.php\'; return false;"><i class="fa fa-arrow-left"></i><br />Previous<br />Step</button>');
echo('<button tabindex="4" type="submit" id="next" class="nav-next"');
if(!isset($_SESSION['ethnicity'])){
	echo(' style="display:none;"');
}
echo('><i class="fa fa-arrow-right"></i><br />Next<br />Step</button>');
echo('</form>');

include('footer.php');
?>
</body>
</html>