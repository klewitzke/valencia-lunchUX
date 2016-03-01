<?php
include('header.php');
$currStep = 7;
if($_SESSION['maxStep'] < 7) {
	$_SESSION['maxStep'] = 7;
}
?>
<script>
	$(function() {
		$( ".option" ).click(function() {
			if ($(this).attr("id") == "yes") {
				$(this).addClass("selected");
				$("#no").removeClass("selected");
				$("#last-4-ssn, #legend").show();
				$("#last-4-ssn").prop('disabled', false);
				$("#last-4-ssn").focus();
				if($("#last-4-ssn").val().length<11) {
					$("#signature-block,#next").hide();
				} else {
					$("#signature-block").show();
					$("#full-name").focus();
					if ($("#full-name").val().length>0) {
						$( "#next" ).show();
					}
				}
			} else if ($(this).attr("id") == "no") {
				$("#signature-block").show();
				$(this).addClass("selected");
				$("#yes").removeClass("selected");
				$("#last-4-ssn, #legend").hide();
			}
		});
		$( "#full-name" ).keyup(function() {
			if ($("#full-name").val().length>0) {
				$( "#next" ).show();
			} else {
				$( "#next" ).hide();
			}
		});
		$( "#last-4-ssn" ).keyup(function() {
			if ($("#last-4-ssn").val().length==11) {
				$( "#signature-block" ).show();
				$("#full-name").focus();
				if ($("#full-name").val().length>0) {
					$( "#next" ).show();
				}
			} else {
				$( "#signature-block, #next" ).hide();
			}			
		});
		$( ".child-name,.adult-name").click(function() {
			if($(this).closest("tr").hasClass("selected")) {
				$(this).closest("tr").removeClass("selected");
				$("#edit-child-button").hide();
				$("#edit-adult-button").hide();
			} else {
				$("#selected").val($(this).closest("tr").attr("id"));
				$("tr").removeClass("selected");
				$(this).closest("tr").addClass("selected");
				$("#selected").val($(this).closest("tr").attr("id"));
				if($(this).closest("tr").hasClass("child-row-2")) {
					$("#edit-adult-button").hide();
					$("#edit-child-button").show();
				} else {
					$("#edit-child-button").hide();
					$("#edit-adult-button").show();
				}
			}
		});
		$( ".income").click(function() {
			var id = $(this).closest("tr").attr("id");
			if($(this).closest("tr").hasClass("child-row-2")){
				var window_x = (window.innerWidth);
				var window_y = (window.innerHeight);
				var dialog_x = $("#dialog-child"+id).outerWidth();
				var dialog_y = $("#dialog-child"+id).outerHeight();
				var x = ((window_x / 2) - (dialog_x / 2));
				var y = ((window_y / 2) - (dialog_y / 2));
				$("#dialog-child"+id).css({top: y, left: x});
				$("#dialog-child"+id).show();
			} else {
				var window_x = (window.innerWidth);
				var window_y = (window.innerHeight);
				var dialog_x = $("#dialog-adult"+id).outerWidth();
				var dialog_y = $("#dialog-adult"+id).outerHeight();
				var x = ((window_x / 2) - (dialog_x / 2));
				var y = ((window_y / 2) - (dialog_y / 2));
				$("#dialog-adult"+id).css({top: y, left: x});
				$("#dialog-adult"+id).show();
			}
			
		});
		$(".cancel").click(function() {
			$(".dialog").hide();
		});
		jQuery(function($){
			$("#last-4-ssn").mask("XXX-XX-9999",{placeholder:""});
		});
	});
</script>
</head>
<body>
<?php
$hasIncome = 0;
foreach($_SESSION['children'] as $key=>$value) {
	echo('<div class="dialog" id="dialog-child'.$key.'"  style="display:none;">');
	echo('<span style="font-size:24px;font-weight:bold;">'.$value[1].' '.$value[2].' '.$value[3].'</span><br />');
	echo('<table class="persons" style="margin-top:5px;margin-bottom:5px;"><th style="text-align:left">Category</th><th>Amount</th><th style="text-align:left">Frequency</th>');
	$guid = $value[0];
	if(isset($_SESSION['Incomes'])){
		foreach ($_SESSION['Incomes'] as $key_1 => $value_1) {
			if(($value_1[0] == $guid)&&($value_1[1] > 0)) {
				$hasIncome = 1;
				if($value_1[1] == 1) {
					echo('<tr><td>Wages from a job</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
				} elseif ($value_1[1] == 2) {
					echo('<tr><td>Social Security benefits</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
				} elseif ($value_1[1] == 3) {
					echo('<tr><td>Spending money</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
				} elseif ($value_1[1] == 4) {
					echo('<tr><td>Other income</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
				}
				echo($value_1[2]);
				if($value_1[3] == 1) {
					echo('</td><td>Weekly</td></tr>');
				} elseif ($value_1[3] == 2) {
					echo('</td><td>Every 2 weeks</td></tr>');
				} elseif ($value_1[3] == 3) {
					echo('</td><td>Twice per month</td></tr>');
				} elseif ($value_1[3] == 4) {
					echo('</td><td>Monthly</td></tr>');
				}
			}
		}
	}
	if($hasIncome==0) {
		echo('<tr><td colspan="3">No reported income</td></tr>');
	}
	echo('</table>');
	echo('<button class="add" style="width:45%" onClick="parent.location=\'student_income.php?editId='.$key.'\'; return false;"><i class="fa fa-usd"></i> Modify</button><button class="cancel" style="width:45%"><i class="fa fa-times"></i> Close</button>');
	echo('</div>');
	$hasIncome = 0;
}
$hasIncome = 0;
if(isset($_SESSION['adults'])) {
	foreach($_SESSION['adults'] as $key=>$value) {
		echo('<div class="dialog" id="dialog-adult'.$key.'"  style="display:none;">');
		echo('<span style="font-size:24px;font-weight:bold;">'.$value[1].' '.$value[2].' '.$value[3].'</span><br />');
		echo('<table class="persons" style="margin-top:5px;margin-bottom:5px;"><th style="text-align:left">Category</th><th>Amount</th><th style="text-align:left">Frequency</th>');
		$guid = $value[0];
		if(isset($_SESSION['Incomes'])){
			foreach ($_SESSION['Incomes'] as $key_1 => $value_1) {
				if(($value_1[0] == $guid)&&($value_1[1] > 0)) {
					$hasIncome = 1;
					if($value_1[1] == 1) {
						echo('<tr><td>Wages from a job</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					} elseif ($value_1[1] == 2) {
						echo('<tr><td>Social Security benefits</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					} elseif ($value_1[1] == 3) {
						echo('<tr><td>Spending money</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					} elseif ($value_1[1] == 4) {
						echo('<tr><td>Other income</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					} elseif ($value_1[1] == 5) {
						echo('<tr><td>Wages from a job</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					} elseif ($value_1[1] == 6) {
						echo('<tr><td>Military pay</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					} elseif ($value_1[1] == 7) {
						echo('<tr><td>Public assistance</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					} elseif ($value_1[1] == 8) {
						echo('<tr><td>Retirement/disability</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					} elseif ($value_1[1] == 9) {
						echo('<tr><td>Investments & other income</td><td style="text-align:right;padding-left:15px;padding-right:15px;">$');
					}
					echo($value_1[2]);
					if($value_1[3] == 1) {
						echo('</td><td>Weekly</td></tr>');
					} elseif ($value_1[3] == 2) {
						echo('</td><td>Every 2 weeks</td></tr>');
					} elseif ($value_1[3] == 3) {
						echo('</td><td>Twice per month</td></tr>');
					} elseif ($value_1[3] == 4) {
						echo('</td><td>Monthly</td></tr>');
					}
				}
			}
		}
		if($hasIncome==0) {
			echo('<tr><td colspan="3">No reported income</td></tr>');
		}
		echo('</table>');
		if($value[4]==1) {
			echo('<button class="add" style="width:45%" onClick="parent.location=\'hh_member_income.php?editId='.$key.'\'; return false;"><i class="fa fa-usd"></i> Modify</button><button class="cancel" style="width:45%;"><i class="fa fa-times"></i> Close</button>');
		} else {
			echo('<button class="add" style="width:45%" onClick="parent.location=\'non_stu_child_income.php?editId='.$key.'\'; return false;"><i class="fa fa-usd"></i> Modify</button><button class="cancel" style="width:45%;"><i class="fa fa-times"></i> Close</button>');
		}
		echo('</div>');
		$hasIncome = 0;
	}
}
include('progress_bar.php');
?>
<div id="main-container">
<div id="main">
<h2>Final Review</h2>
<div class="warning-box" style="margin-bottom:5px; font-weight:bold;font-size:16px;"><i class="fa fa-exclamation-triangle"></i> YOUR APPLICATION HAS NOT YET BEEN SUBMITTED!</div>
<form action="signature_process.php" method="post">
<input type="hidden" name="selected" id="selected" />
<div style="font-size:20px;">
<table id="persons" class="persons">
<tr>
<th style="text-align:left;">Name<br /><span style="font-size:14px;">Click or tap a name to select</span></th>
<th style="text-align:left;"></th>
<?php
if($_SESSION['FASTRACK']==0) {
	echo('<th>Annual<br />Income</th>');
}
echo('</tr>');
$grandTotal = 0;
$personTotal = 0;
$_SESSION['children'] = array_values($_SESSION['children']);
foreach($_SESSION['children'] as $key=>$value) {
	$guid = $value[0];
	if(isset($_SESSION['Incomes'])){
		foreach ($_SESSION['Incomes'] as $key_1 => $value_1) {
			if($value_1[0] == $guid) {
				if($value_1[3] == 1) {
					$personTotal += ($value_1[2] * 52);
				} else if ($value_1[3] == 2) {
					$personTotal += ($value_1[2] * 26);
				} else if ($value_1[3] == 3) {
					$personTotal += ($value_1[2] * 24);
				} else if ($value_1[3] == 4) {
					$personTotal += ($value_1[2] * 12);
				}
			}
		}
	}
	echo ('<tr id="'.$key.'" class="child-row-2"><td class="child-name">'.$value[1].' '.$value[2].' '.$value[3]);
	if($value[5]==1) {
		echo('<span class="condition-alert"><br /><i class="fa fa-check-circle-o"></i> Head Start</span>');
	}
	if($value[6]==1) {
		echo('<span class="condition-alert"><br /><i class="fa fa-check-circle-o"></i> Homeless, Migrant or Runaway</span>');
	}
	if($value[4]==1) {
		echo('<span class="condition-alert"><br /><i class="fa fa-check-circle-o"></i> Foster Child</span>');
	}
	echo('</td><td class="child-name">Student</td>');
	if($_SESSION['FASTRACK']==0) {
		echo('<td class="income" style="text-align:right;">$'.number_format($personTotal,0,'',',').'</td>');
	}
	echo('</tr>');
	$grandTotal += $personTotal;
	$personTotal = 0;
}

if(isset($_SESSION['adults'])){
	$_SESSION['adults'] = array_values($_SESSION['adults']);
	foreach($_SESSION['adults'] as $key=>$value) {
		$guid = $value[0];
		foreach ($_SESSION['Incomes'] as $key_1 => $value_1) {
			if($value_1[0] == $guid) {
				if($value_1[3] == 1) {
					$personTotal += ($value_1[2] * 52);
				} else if ($value_1[3] == 2) {
					$personTotal += ($value_1[2] * 26);
				} else if ($value_1[3] == 3) {
					$personTotal += ($value_1[2] * 24);
				} else if ($value_1[3] == 4) {
					$personTotal += ($value_1[2] * 12);
				}
			}
		}
		echo('<tr id="'.$key.'" class="adult-row-2"><td class="adult-name">'.$value[1].' '.$value[2].' '.$value[3].'</td><td class="adult-name">');
		if($value[4]==1) {
			echo('Adult');
		} else {
			echo('Child');
		}
		echo('</td>');
		if($_SESSION['FASTRACK']==0) {
			echo('<td class="income" style="text-align:right;">$'.number_format($personTotal,0,'',',').'</td>');
		}
		echo('</tr>');
		$grandTotal += $personTotal;
		$personTotal = 0;
	}
}
if($_SESSION['FASTRACK']==0) {
	echo('<tr style="background-color:white;"><td colspan="3" style="text-align:right;font-weight:bold;">Total Household Income: $'.number_format($grandTotal,0,'',',').'</td></tr>');
}
?>
</table>
<button type="submit" name="EditChild" class="add" id="edit-child-button" style="display:none;"><i class="fa fa-pencil"></i> Edit Selected Student</button><button type="submit" name="EditAdult" class="add" id="edit-adult-button" style="display:none;"><i class="fa fa-pencil"></i> Edit Selected Household Member</button>

<b>Contact Information</b><br />
<?php
if(!empty($_SESSION['addr1'])) echo(strtoupper($_SESSION['addr1']));
if(!empty($_SESSION['addr2'])) echo(' '.strtoupper($_SESSION['addr2']));
if(!empty($_SESSION['addr1'])||!empty($_SESSION['addr2'])) echo('<br />');
echo(strtoupper($_SESSION['city']).', '.$_SESSION['state'].' '.$_SESSION['zip'].'<br />');
if(!empty($_SESSION['phone'])) echo('Phone number: ('.substr($_SESSION['phone'],0,3).') '.substr($_SESSION['phone'],3,3).'-'.substr($_SESSION['phone'],6,4).'<br />');
if(!empty($_SESSION['email'])) echo('Email address: '.$_SESSION['email'].'<br />');
?>
</div>
<button tabindex="1" class="add" onClick="parent.location='contact.php'; return false;"><i class="fa fa-pencil"></i> Edit Contact Information</button>
<span style="font-size:16px;font-weight:bold;color:red;">This application is being made in connection with the receipt of Federal funds. School officials may verify the information on the application. Deliberate misrepresentation of the information may subject you (the applicant) to prosecution under State and Federal statutes.</span><br />
<b>Does the household's primary wage earner have a social security number?</b><br /><button id="yes" class="option" onClick="return false;">Yes</button><button id="no" class="option" onClick="return false;">No</button><br />
<span id="legend" style="display:none;"><b>What are the last four (4) digits?</b><br /></span>
<input type="text" name="last4ssn" id="last-4-ssn" autocomplete="off" style="display:none;" disabled /><p>
<div id="signature-block" style="display:none;" >
<b>Confirm the information on this page is correct, then type your full name below:</b>
<input tabindex="1" type="text" name="fullname" id="full-name" placeholder="Full name" style="margin-bottom:5px;" autocomplete="off" /><p>
<b>Today's date:</b>
<input type="text" name="date" value="<?php echo(date("m/d/Y")); ?>" style="text-align:center;" disabled />
</div>
</div>
<button tabindex="3" class="nav-prev" onClick="history.go(-1);return false;"><i class="fa fa-arrow-left"></i><br />Previous<br />Step</button>
<button tabindex="2" type="submit" id="next" class="nav-next" style="display:none;"><i class="fa fa-check"></i><br />Submit<br />Application</button>
</form>
<?php include('footer.php'); ?>
</body>
</html>