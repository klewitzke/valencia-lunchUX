<?php
session_start();
if($_SESSION['Index_Check']!=1){
	header("Location:index.php");
	die();
}
if(!isset($onConfirmationPage)) {
	if($_SESSION['ApplicationSubmitted']==1) {
		header("Location:confirmation.php");
		die();
	}
}
?>


<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
<title>Application for Free and Reduced Price School Meals</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="jquery.maskedinput.js" type="text/javascript"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<script src="jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="external/jquery/jquery.js"></script>

<script type="text/javascript">
function googleTranslateElementInit() {
	new google.translate.TranslateElement({
		pageLanguage: 'en',
		layout: google.translate.TranslateElement.InlineLayout.VERTICAL,
		autoDisplay: false }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
