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
			if ($(this).attr("id") == "opt1a") {
				$(this).addClass("selected");
				$("#opt2a").removeClass("selected");
				$("#opt3a").removeClass("selected");
				$("#ethnicity").val("1");
				$("#race-div").show();
			} else if ($(this).attr("id") == "opt2a") {
				$(this).addClass("selected");
				$("#opt1a").removeClass("selected");
				$("#opt3a").removeClass("selected");
				$("#ethnicity").val("2");
				$("#race-div").show();
			} else if ($(this).attr("id") == "opt3a") {
				$(this).addClass("selected");
				$("#opt1a").removeClass("selected");
				$("#opt2a").removeClass("selected");
				$("#ethnicity").val("3");
				$("#race-div").show();
			}

			if (($(this).attr("id") == "opt1")||($(this).attr("id") == "opt2")||($(this).attr("id") == "opt3")||($(this).attr("id") == "opt4")||($(this).attr("id") == "opt5")) {
				$(this).toggleClass("selected");
				if(($("#opt1").hasClass("selected"))||($("#opt2").hasClass("selected"))||($("#opt3").hasClass("selected"))||($("#opt4").hasClass("selected"))||($("#opt5").hasClass("selected"))) {
					$("#opt6").removeClass('selected');
				} else {
					$("#opt6").addClass('selected');
				}
			} else if ($(this).attr("id") == "opt6") {
				$(this).addClass('selected');
				$("#opt1").removeClass('selected');
				$("#opt2").removeClass('selected');
				$("#opt3").removeClass('selected');
				$("#opt4").removeClass('selected');
				$("#opt5").removeClass('selected');
			}

			if($("#opt1").hasClass("selected")) {
				$("#race1").val("1");
			} else {
				$("#race1").val("0");
			}

			if($("#opt2").hasClass("selected")) {
				$("#race2").val("1");
			} else {
				$("#race2").val("0");
			}

			if($("#opt3").hasClass("selected")) {
				$("#race3").val("1");
			} else {
				$("#race3").val("0");
			}

			if($("#opt4").hasClass("selected")) {
				$("#race4").val("1");
			} else {
				$("#race4").val("0");
			}

			if($("#opt5").hasClass("selected")) {
				$("#race5").val("1");
			} else {
				$("#race5").val("0");
			}

			if( ($("#opt1a").hasClass("selected")||$("#opt2a").hasClass("selected")||$("#opt3a").hasClass("selected"))&&($("#opt1").hasClass("selected")||$("#opt2").hasClass("selected")||$("#opt3").hasClass("selected")||$("#opt4").hasClass("selected")||$("#opt5").hasClass("selected")||$("#opt6").hasClass("selected"))) {
				$( "#next" ).show();
			}
		});
	});
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<form action="optional_1_process.php" method="post">
<?php
echo('<input type="hidden" name="ethnicity" id="ethnicity"');
if(isset($_SESSION['ethnicity'])) {
	echo(' value="'.$_SESSION['ethnicity'].'"');
}
echo(' /><input type="hidden" name="race1" id="race1"');
if(isset($_SESSION['race1'])) {
	echo(' value="'.$_SESSION['race1'].'"');
}
echo(' /><input type="hidden" name="race2" id="race2"');
if(isset($_SESSION['race2'])) {
	echo(' value="'.$_SESSION['race2'].'"');
}
echo(' /><input type="hidden" name="race3" id="race3"');
if(isset($_SESSION['race3'])) {
	echo(' value="'.$_SESSION['race3'].'"');
}
echo(' /><input type="hidden" name="race4" id="race4"');
if(isset($_SESSION['race4'])) {
	echo(' value="'.$_SESSION['race4'].'"');
}
echo(' /><input type="hidden" name="race5" id="race5"');
if(isset($_SESSION['race5'])) {
	echo(' value="'.$_SESSION['race5'].'"');
}
echo(' /><b>Ethnicity (select one):</b><br /><button tabindex="1" id="opt1a" class="option');
if(isset($_SESSION['ethnicity']) && $_SESSION['ethnicity']==1) {
	echo(' selected');
}
echo('" onClick="return false;">Hispanic or<br />Latino</button><button tabindex="2" id="opt2a" class="option');
if(isset($_SESSION['ethnicity']) && $_SESSION['ethnicity']==2) {
	echo(' selected');
}
echo('" onClick="return false;">Not Hispanic or Latino</button><button tabindex="3" id="opt3a" class="option');
if(isset($_SESSION['ethnicity']) && $_SESSION['ethnicity']==3) {
	echo(' selected');
}
echo('" onClick="return false;">Decline Response</button><br />');
echo('<div id="race-div"');
if(!isset($_SESSION['ethnicity'])) {
	echo(' style="display:none;"');
}
echo('><b>Race (select one or more):</b><br />');
echo('<button tabindex="1" id="opt1" class="option');
if(isset($_SESSION['race1']) && $_SESSION['race1']==1) {
	echo(' selected');
}
echo('" onClick="return false;">American Indian or Alaskan Native</button><button tabindex="2" id="opt2" class="option');
if(isset($_SESSION['race2']) && $_SESSION['race2']==1) {
	echo(' selected');
}
echo('" onClick="return false;">Asian</button><button tabindex="3" id="opt3" class="option');
if(isset($_SESSION['race3']) && $_SESSION['race3']==1) {
	echo(' selected');
}
echo('" onClick="return false;">Black or African American</button><button tabindex="4" id="opt4" class="option');
if(isset($_SESSION['race4']) && $_SESSION['race4']==1) {
	echo(' selected');
}
echo('" onClick="return false;">Native Hawaiian or Other Pacific Islander</button><button tabindex="5" id="opt5" class="option');
if(isset($_SESSION['race5']) && $_SESSION['race5']==1) {
	echo(' selected');
}
echo('" onClick="return false;">White</button><button tabindex="6" id="opt6" class="option');
if(((isset($_SESSION['race1']))&&(isset($_SESSION['race2']))&&(isset($_SESSION['race3']))&&(isset($_SESSION['race4']))&&(isset($_SESSION['race5']))) && (($_SESSION['race1']==0)&&($_SESSION['race2']==0)&&($_SESSION['race3']==0)&&($_SESSION['race4']==0)&&($_SESSION['race5']==0))) {
	echo(' selected');
}
echo('" onClick="return false;">Decline Response</button>');

echo('</div></div>');
echo('<button tabindex="5" class="nav-prev" onClick="parent.location=\'optional.php\'; return false;"><i class="fa fa-arrow-left"></i><br />Previous<br />Step</button>');
echo('<button tabindex="4" type="submit" id="next" class="nav-next"');
if(!isset($_SESSION['ethnicity'])) {
	echo(' style="display:none;"');
}
echo('><i class="fa fa-arrow-right"></i><br />Next<br />Step</button>');

echo('</form>');
include('footer.php');
?>
</body>
</html>