<?php include('header.php');
$currStep = 2;
if($_SESSION['maxStep'] < 2) {
	$_SESSION['maxStep'] = 2;
}
?>
<script>
	$(function() {
		$( ".option" ).click(function() {
			if ($(this).attr("id") == "yes") {
				$(this).addClass("selected");
				$("#no").removeClass("selected");
				$("#case").val("1");
				$("#casenum, #legend").show();
				$("#casenum").focus();
				if($("#casenum").val().length==0) {
					$("#next").hide();
				}
			} else if ($(this).attr("id") == "no") {
				$("#next").show();
				$(this).addClass("selected");
				$("#yes").removeClass("selected");
				$("#case").val("0");
				$("#casenum, #legend").hide();
			}
		});
		$( "#casenum" ).keyup(function() {
			if ($("#casenum").val().length>0) {
				$( "#next" ).show();
			} else {
				$( "#next" ).hide();
			}			
		});
		$( "#info-q" ).click(function() {
			$("#info-box").toggleClass("hidden");
		});
	});
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<form action="case_process.php" method="post">
<input type="hidden" name="case" id="case"
<?php
if(isset($_SESSION['case'])) {
	echo(' value="'.$_SESSION['case'].'"');
}
?>
 />
<b>Do any Household Members (including you) currently participate in one or more of the following assistance programs: SNAP, TANF, or FDPIR?</b><!-- &nbsp;&nbsp;<i id="info-q" class="fa fa-question-circle" style="color:skyblue;"></i> --><br />
<div id="info-box" style="font-size:16px; text-align:left;">
<b><u>SNAP</u>:</b> Supplemental Nutrition Assistance Program<br />(formerly known as food stamps)<br />
<b><u>TANF</u>:</b> Temporary Assistance for Needy Families<br />
<b><u>FDPIR</u>:</b> Food Distribution Program on Indian Reservations
</div>
<button id="yes" class="option
<?php
if(isset($_SESSION['case']) && $_SESSION['case']==1) {
	echo(' selected');
}
?>
" onClick="return false;">Yes</button><button id="no" class="option
<?php
if(isset($_SESSION['case']) && $_SESSION['case']==0) {
	echo(' selected');
}
?>
" onClick="return false;" style="margin-bottom: 5px;">No</button><br />
<span id="legend"
<?php
if(!isset($_SESSION['casenum'])){
	echo(' style="display:none;"');
}
?>
><b>Enter Case Number:</b></span>
<input type="tel" name="casenum" id="casenum"
<?php
if(isset($_SESSION['casenum'])){
	echo(' value="'.$_SESSION['casenum'].'"');
}
?>
 style="
<?php
if(!isset($_SESSION['casenum'])){
	echo('display:none;');
}
?>
text-align:center;" autocomplete="off" />
</div>
<button type="submit" id="next" class="nav-next"
<?php
if(!isset($_SESSION['case'])) {
	echo(' style="display:none;"');
}
?>
><i class="fa fa-arrow-right"></i><br />Next<br />Step</button>
</form>
<?php include('footer.php'); ?>
</body>
</html>