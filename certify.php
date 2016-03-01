<?php
include('header.php');
$currStep = 1;
if(!isset($_SESSION['maxStep'])) {
	$_SESSION['maxStep'] = 1;
}
?>
<script>
	$(function() {
		$( ".option" ).click(function() {
			$(this).toggleClass("selected");
			if($(this).hasClass("selected")) {
				$("#next").show();
			} else {
				$("#next").hide();
			}
		});
	});
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<h2>Application for Free and Reduced Price School Meals</h2><b><p>Before we begin, please read and agree to the following statements:</b></p>
<form action="certify_process.php" method="post" style="text-align:left;">
<p><i class="fa fa-check" style="color:green;"></i> I promise that the information I am providing is true, and that all income is reported</p><p><i class="fa fa-check" style="color:green;"></i> I understand that this information is given in connection with the receipt of Federal funds, and that school officials may verify the information</p><p><i class="fa fa-check" style="color:green;"></i> I am aware that if I purposely give false information, my children may lose meal benefits, and I may be prosecuted under applicable State and Federal laws</p>
</div>
<button tabindex="2" type="submit" id="next" class="nav-next"><i class="fa fa-check"></i><br />I agree</button>
</form>
<?php include('footer.php'); ?>
</body>
</html>