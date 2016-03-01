<br />
<form action="abandon.php" method="post">
<?php
if($currStep < 8) {
	echo('<button class="cancel" style="max-width:250px;font-size:18px;" onclick="return confirm(\'Are you sure you want to abandon this application? Your progress will not be saved.\\nPress OK to abandon application\\nPress Cancel to return to application\');"><i class="fa fa-ban" style="color:red;"></i> Cancel Application</button>');
} else {
	echo('<button class="cancel" style="max-width:250px;font-size:18px;"><i class="fa fa-sign-out"></i> Log Out</button>');
}
?>
</form>
</div>
<script>
	$(function() {
		$( "#change-lang" ).click(function() {
			$("#google_translate_element").show();
			$("#lang-en,#lang-es,#lang-fr,#lang-ge,#change-lang,#br").hide();
		});
	});
</script><br />
<div id="google_translate_element" style="max-width:200px;margin-left:auto;margin-right:auto;"></div>
<a id="change-lang" style="font-size:16px;">Change Language<br /></a>
<a href="terms.php" style="font-size:16px;">Terms & Conditions</a>

<?php
if(!isset($_SESSION['bgcounter'])) {
	$_SESSION['bgcounter'] = 0;
}
echo('<div id="background" style="background-image: url(bg/'.$_SESSION['bgcounter'].'.jpg);" />');
if($_SESSION['bgcounter']<12) {
	$_SESSION['bgcounter']++;
} else {
	$_SESSION['bgcounter'] = 0;
}
?>