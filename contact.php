<?php
include('header.php');
include('dbconnect.php');
$currStep = 6;
if($_SESSION['maxStep'] < 6) {
	$_SESSION['maxStep'] = 6;
}
?>
</head>
<body>
<?php include('progress_bar.php'); ?>
<script>
	$(function() {
		$( "#zip" ).keyup(function() {
			if ($("#zip").val().length>4) {
				$( "#addr1,#addr2,#city,#state-select,#next" ).show();
				jQuery.ajax({
					url: 'zip_lookup_city.php?zip=' + $(this).val(),
					success: function (result) {
						$("#city").val(result);
					},
					async: false
				});
				jQuery.ajax({
					url: 'zip_lookup_state.php?zip=' + $(this).val(),
					success: function (result) {
						if(result.length == 2) {
							$("#state-select").val(result);
							$("#state-hidden").val(result);
							$("#state-select").attr("disabled",true);
						} else {
							$("#state-select").removeAttr("disabled");
							$("#state-hidden").val("");
						}
					},
					async: false
				});
			} else {
				$( "#next" ).hide();
			}
		});
		jQuery(function($){
			$("#zip").mask("99999",{placeholder:""});
			$("#phone").mask("(999) 999-9999");
		});
	});
</script>
<div id="main-container">
<div id="main">
<b>Please complete the following fields as applicable:</b>
<form action="contact_process.php" method="post">
<input type="hidden" name="state-hidden" id="state-hidden" value="<?php if(isset($_SESSION['state'])) echo($_SESSION['state']); ?>" />
<input tabindex="1" name="zip" id="zip" type="tel" placeholder="ZIP code" maxlength="5" pattern="[0-9]{5}" value="<?php if(isset($_SESSION['zip'])) echo($_SESSION['zip']); ?>" required autocomplete="off" />
<input tabindex="2" name="addr1" id="addr1" type="text" placeholder="Street address" <?php if(!isset($_SESSION['zip'])) echo('style="display:none;"'); ?> value="<?php if(isset($_SESSION['addr1'])) echo($_SESSION['addr1']); ?>" autocomplete="off" />
<input tabindex="3" name="addr2" id="addr2" type="text" placeholder="Apt #" <?php if(!isset($_SESSION['zip'])) echo('style="display:none;"'); ?> value="<?php if(isset($_SESSION['addr2'])) echo($_SESSION['addr2']); ?>" autocomplete="off" />
<input tabindex="4" name="city" id="city" type="text" placeholder="City" <?php if(!isset($_SESSION['zip'])) echo('style="display:none;"'); ?> value="<?php if(isset($_SESSION['city'])) echo($_SESSION['city']); ?>" required autocomplete="off" />
<?php include('state_list.php'); ?>
<input tabindex="6" name="phone" id="phone" type="tel" placeholder="Phone number (optional)" autocomplete="off" value="<?php if(isset($_SESSION['phone'])) echo($_SESSION['phone']); ?>" />
<input tabindex="7" name="email" id="email" type="email" placeholder="Email address (optional)" autocomplete="off" value="<?php if(isset($_SESSION['email'])) echo($_SESSION['email']); ?>" />
</div>
<input type="submit" style="display:none;" />
<button tabindex="9" id="prev" class="nav-prev" onClick="history.go(-1);return false;"><i class="fa fa-arrow-left"></i><br />Previous<br />Step</button>
<button tabindex="8" type="submit" id="next" class="nav-next" <?php if(!isset($_SESSION['zip'])) echo('style="display:none;"'); ?>><i class="fa fa-arrow-right"></i><br />Next<br />Step</button>
</form>
<?php include('footer.php'); ?>
</body>
</html>