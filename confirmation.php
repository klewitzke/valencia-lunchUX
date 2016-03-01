<?php
$onConfirmationPage = 1;
include('header.php');
$currStep = 8;
if($_SESSION['maxStep'] < 8) {
	$_SESSION['maxStep'] = 8;
}
?>
<script>
	$(function() {
		$("#email-option").click(function() {
			$("#legend,#confirmation_email,#send").show();
			$("#confirmation_email").focus();
			$("#email-option").hide();
		});
		$("#send").click(function() {
			jQuery.ajax({
				url: 'send_email.php?email=' + $("#confirmation_email").val(),
				success: function (result) {
					alert("A confirmation email has been sent to: " + result);
				},
				async: false
			});
			$("#legend,#confirmation_email,#send").hide();
			$("#email-option").show();
			$("#email-option").val("");
		});
	});
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<h2>Confirmation</h2>
<?php
$longApp_ID = str_pad($_SESSION['App_ID'],12,'0',STR_PAD_LEFT);
echo('<p><b>Congratulations! Your application has been submitted successfully.</b></p>');

echo('<p>Your confirmation number is<br /><b>'.substr($longApp_ID,0,4).'-'.substr($longApp_ID,4,4).'-'.substr($longApp_ID,8,4).'</b></p>');
echo('<button class="add" id="email-option" style="max-width:250px;font-size:18px;"><i class="fa fa-envelope-o"></i> Email Confirmation</button>');
echo('<span id="legend" style="display:none;">Send email confirmation to:</span>');
echo('<input type="email" id="confirmation_email" style="display:none;" value="');
if(isset($_SESSION['email'])) {
	echo($_SESSION['email']);
}
echo('" /><button class="add" style="max-width:250px;font-size:18px;display:none;" id="send"><i class="fa fa-paper-plane-o"></i> Send Now</button><br />');
echo('<button class="add" style="max-width:250px;font-size:18px;" onClick="window.open(\'confirmation_print.php\',\'_blank\');"><i class="fa fa-print"></i> Print Confirmation</button>');
include('footer.php');
?>
</body>
</html>