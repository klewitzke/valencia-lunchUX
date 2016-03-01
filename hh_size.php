<?php include('header.php');
$currStep = 4;
if($_SESSION['maxStep'] < 4) {
	$_SESSION['maxStep'] = 4;
}
?>
<script>
	$(function() {
		$( ".cancel" ).click(function() {
			$("#next").show();
			var num = $("#numberhidden").val();
			if ($(this).attr("id") == "plus") {
				num++;
				$("#numberhidden").val(num);
				$("#numberdisplay").html(num);
			} else if ($(this).attr("id") == "minus") {
				num--;
				$("#numberhidden").val(num);
				$("#numberdisplay").html(num);
			}
			if(num==1) {
				$("#minus").prop("disabled","disabled");
			} else {
				$("#minus").removeAttr("disabled");
			}
		});
	});
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<form action="hh_size_process.php" method="post">
<input type="hidden" id="numberhidden" name="numberhidden" value="0" />
<p>We need to confirm that <b><u>ALL</u></b> children, students and other members of your household (even those who are not your direct dependent or not attending school) have been entered on this application</p><p><b>Please choose the total number of household members below:</b></p>
<button id="minus" class="cancel" onClick="return false;" style="width:30%;height:100px;font-size:64px;color:red;" disabled><i class="fa fa-minus-circle"></i></button><div id="numberdisplay" style="font-size:64px;width:30%;height:100px;display:inline-block;">0</div><button id="plus" class="cancel" onClick="return false;" style="width:30%;height:100px;font-size:64px;color:green;"><i class="fa fa-plus-circle"></i></button><br />
</div>
<button class="nav-prev" onClick="parent.location='add_hh_member.php'; return false;" ><i class="fa fa-arrow-left"></i><br />Previous<br />Step</button><button type="submit" id="next" class="nav-next" style="display:none;"><i class="fa fa-arrow-right"></i><br />Next<br />Step</button>
</form>
<?php include('footer.php'); ?>
</body>
</html>