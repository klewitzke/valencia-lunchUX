<?php
include('header.php');
$currStep = 4;
if($_SESSION['maxStep'] < 4) {
	$_SESSION['maxStep'] = 4;
}
if(!isset($_SESSION['Incomes'])) {
	$_SESSION['Incomes'] = array();
}
if(isset($_GET['editId'])) {
	$cat1 = 0;
	$cat2 = 0;
	$cat3 = 0;
	$cat4 = 0;
	$_SESSION['ChildNumber'] = $_GET['editId'];
	$guid = $_SESSION['children'][$_SESSION['ChildNumber']][0];
	foreach($_SESSION['Incomes'] as $key_1=>$value_1) {
		if($value_1[0]==$guid) {
			if($value_1[1]==1) $cat1 = 1;
			if($value_1[1]==2) $cat2 = 1;
			if($value_1[1]==3) $cat3 = 1;
			if($value_1[1]==4) $cat4 = 1;
		}
	}
} else {
	$_SESSION['ChildNumber'] = 0;
	do {
		if($_SESSION['ChildNumber']==($_SESSION['ChildCount'])){
			header("Location:non_stu_child_income.php");
			die();
		}
		$incomeReported = 0;
		$guid = $_SESSION['children'][$_SESSION['ChildNumber']][0];
		if(isset($_SESSION['Incomes'])){
			foreach($_SESSION['Incomes'] as $key_1=>$value_1) {
				if($value_1[0]==$guid) {
					$incomeReported = 1;
				}
			}
			if($incomeReported == 1) {
				$_SESSION['ChildNumber']++;
			}
		}
	} while ($incomeReported == 1);
}
?>
<script>
	$(function() {
		$(document).on("click", ".option-full-text,#opt1-close,#opt2-close,#opt3-close,#opt4-close", function(event) {
			$( "#next" ).show();
			if (($(this).attr("id") == "opt1-text")||($(this).attr("id") == "opt1-close")) {
				$("#opt1").toggleClass("selected");
			} else if (($(this).attr("id") == "opt2-text")||($(this).attr("id") == "opt2-close")) {
				$("#opt2").toggleClass("selected");
			} else if (($(this).attr("id") == "opt3-text")||($(this).attr("id") == "opt3-close")) {
				$("#opt3").toggleClass("selected");
			} else if (($(this).attr("id") == "opt4-text")||($(this).attr("id") == "opt4-close")) {
				$("#opt4").toggleClass("selected");
			} else if ($(this).attr("id") == "opt5-text") {
				$("#opt5").addClass('selected');
				$("#opt1").removeClass('selected');
				$("#opt2").removeClass('selected');
				$("#opt3").removeClass('selected');
				$("#opt4").removeClass('selected');
			}

			if($("#opt1").hasClass("selected")) {
				$("#opt1-table,#opt1-add,#opt1-close").show();
				$(".opt1-wage,.opt1-frequency").prop('required',true);
				$(".opt1-wage,.opt1-frequency").prop('disabled',false);
			} else {
				$("#opt1-table,#opt1-add,#opt1-close").hide();
				$(".opt1-wage,.opt1-frequency").removeAttr('required');
				$(".opt1-wage,.opt1-frequency").prop('disabled','disabled');
			}

			if($("#opt2").hasClass("selected")) {
				$("#opt2-table,#opt2-add,#opt2-close").show();
				$(".opt2-wage,.opt2-frequency").prop('required',true);
				$(".opt2-wage,.opt2-frequency").prop('disabled',false);
			} else {
				$("#opt2-table,#opt2-add,#opt2-close").hide();
				$(".opt2-wage,.opt2-frequency").removeAttr('required');
				$(".opt2-wage,.opt2-frequency").prop('disabled','disabled');
			}

			if($("#opt3").hasClass("selected")) {
				$("#opt3-table,#opt3-add,#opt3-close").show();
				$(".opt3-wage,.opt3-frequency").prop('required',true);
				$(".opt3-wage,.opt3-frequency").prop('disabled',false);
			} else {
				$("#opt3-table,#opt3-add,#opt3-close").hide();
				$(".opt3-wage,.opt3-frequency").removeAttr('required');
				$(".opt3-wage,.opt3-frequency").prop('disabled','disabled');
			}

			if($("#opt4").hasClass("selected")) {
				$("#opt4-table,#opt4-add,#opt4-close").show();
				$(".opt4-wage,.opt4-frequency").prop('required',true);
				$(".opt4-wage,.opt4-frequency").prop('disabled',false);
			} else {
				$("#opt4-table,#opt4-add,#opt4-close").hide();
				$(".opt4-wage,.opt4-frequency").removeAttr('required');
				$(".opt4-wage,.opt4-frequency").prop('disabled','disabled');
			}
			
			if(($("#opt1").hasClass("selected"))||($("#opt2").hasClass("selected"))||($("#opt3").hasClass("selected"))||($("#opt4").hasClass("selected"))) {
				$("#opt5").removeClass('selected');
			} else {
				$("#opt5").addClass('selected');
			}
		});
		$(document).on("click", "#opt1-add", function(event){
			var newRow = jQuery('<tr><td style="color:white;">$</td><td style="width:50%"><input class="opt1-wage" type="tel" name="opt1-wageamt[]" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" required /></td><td style="width:50%"><select name="opt1-frequency[]" class="opt1-frequency"  required ><option disabled selected>Frequency</option><option value="1">Weekly</option><option value="2">Every 2 Weeks</option><option value="3">Twice Monthly</option><option value="4">Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;">Remove</td></tr>');
			$("#opt1-table").append(newRow);
		});
		$(document).on("click", "#opt2-add", function(event){
			var newRow = jQuery('<tr><td style="color:white;">$</td><td style="width:50%"><input class="opt2-wage" type="tel" name="opt2-wageamt[]" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" required /></td><td style="width:50%"><select name="opt2-frequency[]" class="opt2-frequency"  required ><option disabled selected>Frequency</option><option value="1">Weekly</option><option value="2">Every 2 Weeks</option><option value="3">Twice Monthly</option><option value="4">Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;">Remove</td></tr>');
			$("#opt2-table").append(newRow);
		});
		$(document).on("click", "#opt3-add", function(event){
			var newRow = jQuery('<tr><td style="color:white;">$</td><td style="width:50%"><input class="opt3-wage" type="tel" name="opt3-wageamt[]" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" required /></td><td style="width:50%"><select name="opt3-frequency[]" class="opt3-frequency"  required ><option disabled selected>Frequency</option><option value="1">Weekly</option><option value="2">Every 2 Weeks</option><option value="3">Twice Monthly</option><option value="4">Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;">Remove</td></tr>');
			$("#opt3-table").append(newRow);
		});
		$(document).on("click", "#opt4-add", function(event){
			var newRow = jQuery('<tr><td style="color:white;">$</td><td style="width:50%"><input class="opt4-wage" type="tel" name="opt4-wageamt[]" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" required /></td><td style="width:50%"><select name="opt4-frequency[]" class="opt4-frequency"  required ><option disabled selected>Frequency</option><option value="1">Weekly</option><option value="2">Every 2 Weeks</option><option value="3">Twice Monthly</option><option value="4">Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;">Remove</td></tr>');
			$("#opt4-table").append(newRow);
		});
		$(document).on("click", "#remove", function(event){
			$(this).closest("tr").remove();
		});
		$(document).on("click", "#next", function(event){
		var patt = new RegExp("^0*[0-9][0-9]*(\\.[0-9]+)?|0+\\.[0-9]*[1-9][0-9]*$");
			var invalid = 0;
			$("select:enabled").each(function(){
				if($(this).is('.opt1-frequency, .opt2-frequency, .opt3-frequency, .opt4-frequency, .opt5-frequency')) {
					if($(this).val() == null) {
						invalid = 1;
					} 
				}
			});
			$("input:enabled").each(function(){
				if($(this).is('.opt1-wage, .opt2-wage, .opt3-wage, .opt4-wage, .opt5-wage')) {
					var str = $(this).val();
					
					var res = patt.test(str);
					if(res==false) {
						invalid = 2;
					}
				}
			});
			if(invalid == 1) {
				alert("You must select a frequency for each income amount.");
			} else if(invalid==2) {
				alert("You must enter a numeric value for each income amount.");
			} else {
				$("#form").submit();
			}
		});
		$(document).on("blur", ".opt1-wage,.opt2-wage,.opt3-wage,.opt4-wage", function(event) {
			$(this).val(Number(Math.round(this.value.replace(/[^\d.-]/g, ''),0)).toFixed(2));
		});
	});
		
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<form action="student_income_process.php" id="form" method="post">
<input type="hidden" name="edit_in_progress" value="
<?php
if(isset($_GET['editId'])) {
	echo('1');
} else {
	echo('0');
}
?>
" />
<input type="hidden" name="earnings" id="earnings" />
<b>Do any of the following apply to <u>
<?php
echo(strtoupper($_SESSION['children'][$_SESSION['ChildNumber']][1]));
?>
</u>?</b><br />(select all that apply)

<?php

// Salary or wages from a job
echo('<div tabindex="1" id="opt1" class="option-full');
if(isset($_GET['editId']) && $cat1==1) echo(' selected');
echo('" onClick="return false;"><div class="option-full-text" id="opt1-text">Earns a salary or wages from a job</div><br />');
if(isset($_GET['editId']) && $cat1==1) {
	echo('<table id="opt1-table">');
	$i=0;
	foreach($_SESSION['Incomes'] as $key_1=>$value_1) {
		if($value_1[0]==$guid) {
			if($value_1[1]==1) {
				echo('<tr><td style="color:white;">$</td><td style="width:50%"><input class="opt1-wage" type="tel" name="opt1-wageamt[]" value="'.$value_1[2].'" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" /></td><td style="width:50%"><select name="opt1-frequency[]" class="opt1-frequency"  ><option disabled>Frequency</option><option value="1"');
				if($value_1[3]==1) echo(' selected');
				echo('>Weekly</option><option value="2"');
				if($value_1[3]==2) echo(' selected');
				echo('>Every 2 Weeks</option><option value="3"');
				if($value_1[3]==3) echo(' selected');
				echo('>Twice Monthly</option><option value="4"');
				if($value_1[3]==4) echo(' selected');
				echo('>Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;');
				if($i==0) echo('visibility:hidden;');
				echo('">Remove</td></tr>');
				$i++;
			}
		}
	}
	echo('</table><button id="opt1-add" class="cancel" style="width:45%;" ><i class="fa fa-usd"></i> Add</button><button id="opt1-close" class="cancel" style="width:45%;"><i class="fa fa-times"></i> Cancel</button></div>');
} else {
	echo('<table id="opt1-table" style="display:none;"><tr><td style="color:white;">$</td><td style="width:50%"><input class="opt1-wage" type="tel" name="opt1-wageamt[]" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" disabled /></td><td style="width:50%"><select name="opt1-frequency[]" class="opt1-frequency"  disabled ><option disabled selected>Frequency</option><option value="1">Weekly</option><option value="2">Every 2 Weeks</option><option value="3">Twice Monthly</option><option value="4">Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;visibility:hidden;">Remove</td></tr></table><button id="opt1-add" class="cancel" style="width:45%;display:none;" ><i class="fa fa-usd"></i> Add</button><button id="opt1-close" class="cancel" style="width:45%;display:none;"><i class="fa fa-times"></i> Cancel</button></div>');
}

// Social Security benefits
echo('<div tabindex="2" id="opt2" class="option-full');
if(isset($_GET['editId']) && $cat2==1) echo(' selected');
echo('" onClick="return false;"><div class="option-full-text" id="opt2-text">Receives Social Security benefits</div><br />');
if(isset($_GET['editId']) && $cat2==1) {
	echo('<table id="opt2-table">');
	$i=0;
	foreach($_SESSION['Incomes'] as $key_1=>$value_1) {
		if($value_1[0]==$guid) {
			if($value_1[1]==2) {
				echo('<tr><td style="color:white;">$</td><td style="width:50%"><input class="opt2-wage" type="tel" name="opt2-wageamt[]" value="'.$value_1[2].'" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" /></td><td style="width:50%"><select name="opt2-frequency[]" class="opt2-frequency"  ><option disabled>Frequency</option><option value="1"');
				if($value_1[3]==1) echo(' selected');
				echo('>Weekly</option><option value="2"');
				if($value_1[3]==2) echo(' selected');
				echo('>Every 2 Weeks</option><option value="3"');
				if($value_1[3]==3) echo(' selected');
				echo('>Twice Monthly</option><option value="4"');
				if($value_1[3]==4) echo(' selected');
				echo('>Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;');
				if($i==0) echo('visibility:hidden;');
				echo('">Remove</td></tr>');
				$i++;
			}
		}
	}
	echo('</table><button id="opt2-add" class="cancel" style="width:45%;" ><i class="fa fa-usd"></i> Add</button><button id="opt2-close" class="cancel" style="width:45%;"><i class="fa fa-times"></i> Cancel</button></div>');
} else {
	echo('<table id="opt2-table" style="display:none;"><tr><td style="color:white;">$</td><td style="width:50%"><input class="opt2-wage" type="tel" name="opt2-wageamt[]" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" disabled /></td><td style="width:50%"><select name="opt2-frequency[]" class="opt2-frequency"  disabled ><option disabled selected>Frequency</option><option value="1">Weekly</option><option value="2">Every 2 Weeks</option><option value="3">Twice Monthly</option><option value="4">Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;visibility:hidden;">Remove</td></tr></table><button id="opt2-add" class="cancel" style="width:45%;display:none;" ><i class="fa fa-usd"></i> Add</button><button id="opt2-close" class="cancel" style="width:45%;display:none;"><i class="fa fa-times"></i> Cancel</button></div>');
}

// Spending money
echo('<div  id="opt3" class="option-full');
if(isset($_GET['editId']) && $cat3==1) echo(' selected');
echo('" onClick="return false;"><div class="option-full-text" id="opt3-text">Regularly receives spending money from outside the household</div><br />');
if(isset($_GET['editId']) && $cat3==1) {
	echo('<table id="opt3-table">');
	$i=0;
	foreach($_SESSION['Incomes'] as $key_1=>$value_1) {
		if($value_1[0]==$guid) {
			if($value_1[1]==3) {
				echo('<tr><td style="color:white;">$</td><td style="width:50%"><input class="opt3-wage" type="tel" name="opt3-wageamt[]" value="'.$value_1[2].'" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" /></td><td style="width:50%"><select name="opt3-frequency[]" class="opt3-frequency"  ><option disabled>Frequency</option><option value="1"');
				if($value_1[3]==1) echo(' selected');
				echo('>Weekly</option><option value="2"');
				if($value_1[3]==2) echo(' selected');
				echo('>Every 2 Weeks</option><option value="3"');
				if($value_1[3]==3) echo(' selected');
				echo('>Twice Monthly</option><option value="4"');
				if($value_1[3]==4) echo(' selected');
				echo('>Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;');
				if($i==0) echo('visibility:hidden;');
				echo('">Remove</td></tr>');
				$i++;
			}
		}
	}
	echo('</table><button id="opt3-add" class="cancel" style="width:45%;" ><i class="fa fa-usd"></i> Add</button><button id="opt3-close" class="cancel" style="width:45%;"><i class="fa fa-times"></i> Cancel</button></div>');
} else {
	echo('<table id="opt3-table" style="display:none;"><tr><td style="color:white;">$</td><td style="width:50%"><input class="opt3-wage" type="tel" name="opt3-wageamt[]" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" disabled /></td><td style="width:50%"><select name="opt3-frequency[]" class="opt3-frequency"  disabled ><option disabled selected>Frequency</option><option value="1">Weekly</option><option value="2">Every 2 Weeks</option><option value="3">Twice Monthly</option><option value="4">Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;visibility:hidden;">Remove</td></tr></table><button id="opt3-add" class="cancel" style="width:45%;display:none;" ><i class="fa fa-usd"></i> Add</button><button id="opt3-close" class="cancel" style="width:45%;display:none;"><i class="fa fa-times"></i> Cancel</button></div>');
}

// Income from any other source
echo('<div tabindex="4" id="opt4" class="option-full');
if(isset($_GET['editId']) && $cat4==1) echo(' selected');
echo('" onClick="return false;"><div class="option-full-text" id="opt4-text">Receives income from any other source</div><br />');
if(isset($_GET['editId']) && $cat4==1) {
	echo('<table id="opt4-table">');
	$i=0;
	foreach($_SESSION['Incomes'] as $key_1=>$value_1) {
		if($value_1[0]==$guid) {
			if($value_1[1]==4) {
				echo('<tr><td style="color:white;">$</td><td style="width:50%"><input class="opt4-wage" type="tel" name="opt4-wageamt[]" value="'.$value_1[2].'" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" /></td><td style="width:50%"><select name="opt4-frequency[]" class="opt4-frequency"  ><option disabled>Frequency</option><option value="1"');
				if($value_1[3]==1) echo(' selected');
				echo('>Weekly</option><option value="2"');
				if($value_1[3]==2) echo(' selected');
				echo('>Every 2 Weeks</option><option value="3"');
				if($value_1[3]==3) echo(' selected');
				echo('>Twice Monthly</option><option value="4"');
				if($value_1[3]==4) echo(' selected');
				echo('>Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;');
				if($i==0) echo('visibility:hidden;');
				echo('">Remove</td></tr>');
				$i++;
			}
		}
	}
	echo('</table><button id="opt4-add" class="cancel" style="width:45%;" ><i class="fa fa-usd"></i> Add</button><button id="opt4-close" class="cancel" style="width:45%;"><i class="fa fa-times"></i> Cancel</button></div>');
} else {
	echo('<table id="opt4-table" style="display:none;"><tr><td style="color:white;">$</td><td style="width:50%"><input class="opt4-wage" type="tel" name="opt4-wageamt[]" style="text-align:center;margin:0;" placeholder="Amount" autocomplete="off" disabled /></td><td style="width:50%"><select name="opt4-frequency[]" class="opt4-frequency"  disabled ><option disabled selected>Frequency</option><option value="1">Weekly</option><option value="2">Every 2 Weeks</option><option value="3">Twice Monthly</option><option value="4">Monthly</option></select></td><td id="remove" style="color:white;font-size:16px;visibility:hidden;">Remove</td></tr></table><button id="opt4-add" class="cancel" style="width:45%;display:none;" ><i class="fa fa-usd"></i> Add</button><button id="opt4-close" class="cancel" style="width:45%;display:none;"><i class="fa fa-times"></i> Cancel</button></div>');
}

?>
<!-- None of the above -->
<div tabindex="5" id="opt5" class="option-full
<?php if(isset($_GET['editId']) && $cat1==0 && $cat2==0 && $cat3==0 && $cat4==0) echo(' selected'); ?>
" onClick="return false;"><div class="option-full-text" id="opt5-text">None of the above</div></div>

</div>
<?php
if(!isset($_GET['editId'])) {
	echo('<button tabindex="7" class="nav-prev" onClick="parent.location=\'add_hh_member.php\'; return false;"><i class="fa fa-arrow-left"></i><br />Previous<br />Step</button>');
}
?>
<button tabindex="6" id="next" class="nav-next"
<?php
if(!isset($_GET['editId'])) {
	echo(' style="display:none;"');
}
?>
 onClick="return false;">
<?php
if(isset($_GET['editId'])) {
	echo('<i class="fa fa-save"></i><br />Save</button>');
} else {
	echo('<i class="fa fa-arrow-right"></i><br />Next<br />Step</button>');
}
?>
</form>
<?php include('footer.php'); ?>
</body>
</html>