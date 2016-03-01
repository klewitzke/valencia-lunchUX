<?php

include('header.php');
if(!isset($_SESSION['adults'])) {
	$_SESSION['adults'] = array();
}

$currStep = 4;
if($_SESSION['maxStep'] < 4) {
	$_SESSION['maxStep'] = 4;
}
?>
<script>
	$(function() {
		$(".adult-row").click(function() {
			if($(this).hasClass("selected")) {
				$("#delete,#edit").hide();
				$(this).removeClass("selected");
			} else {
				if(($("#edit-in-progress").val()==0)&&($("#add-in-progress").val()==0)) {
					$("#delete,#edit").show();
					$("#selected").val($(this).attr("id"));
					$("tr").removeClass("selected");
					$(this).addClass("selected");
				} else {
					alert("Save or Cancel changes before continuing.");
				}
			}			
		});
		$("#edit").click(function() {
			var id = $("#selected").val();
			var fn = $("#"+id).children("td").html();
			var mi = $("#"+id).children("td").next("td").html();
			var ln = $("#"+id).children("td").next("td").next("td").html();
			$("#edit-in-progress").val("1");
			$("#fn-field").val(fn);
			$("#mi-field").val(mi);
			$("#ln-field").val(ln);
			if($("#"+id).attr("data-adult")==1) {
				$("#q1-adult").addClass("selected");
			} else {
				$("#q1-child").addClass("selected");
			}
			$("#q1-name").html(fn);
			$("#delete,#edit,#add-adult-button,.nav-next").hide();
			$("#"+id).hide();
			$("#add-row,#fn-field,#mi-field,#ln-field,#q1,#q1-adult,#q1-child,#cancel2").show();
		});
		$("#add-adult-button").click(function() {
			$("#table,#add-row,#fn-field,#mi-field,#ln-field,#cancel1").show();
			$("#edit-in-progress").val("0");
			$("#add-in-progress").val("1");
			$("#add-adult-button,.nav-next").hide();
			$(".adult-row").removeClass("selected");
			$("#delete,#edit").hide();
		});
		$( "#fn-field,#mi-field,#ln-field" ).keyup(function() {
			if (($("#fn-field").val().length>0)&&($("#ln-field").val().length>0)) {
				if($("#edit-in-progress").val()==1) {
					$("#save2" ).show();
				} else {
					$("#save1" ).show();
				}				
			} else {
				$( "#save1,#save2" ).hide();
			}
		});
		$("#fn-field").blur(function() {
			var fn = $("#fn-field").val().toUpperCase();
			$("#q1-name").html(fn);
		});
		$("#cancel1").click(function() {
			$("#add-row").hide();
			$("#edit-in-progress,#add-in-progress").val("0");
			$("#add-adult-button,.adult-row").show();
			$("#fn-field,#mi-field,#ln-field").val("");
			if($("#adults-array-count").val()>0) {
				$(".nav-next").show();
			}
		});
		$("#save1").click(function() {
			var fn = $("#fn-field").val().toUpperCase();
			var mi = $("#mi-field").val().toUpperCase();
			var ln = $("#ln-field").val().toUpperCase();
			$("<tr style=\"background-color:white;\"><td>" + fn + "</td><td>" + mi + "</td><td>" + ln + "</td></tr>").insertBefore($(this).closest("tr"));
			$("#fn-field,#mi-field,#ln-field,#cancel1,#save1").hide();
			$("#q1-name").html(fn);
			$("#q1,#q1-child,#q1-adult,#cancel2").show();
		});
		$("#cancel2").click(function() {
			$(this).closest("tr").prev().hide();
			$("#edit-in-progress,#add-in-progress").val("0");
			$("#fn-field,#mi-field,#ln-field").val("");
			$(".option").removeClass("selected");
			$("#add-row,#cancel2,#save2,#q1,#q1-adult,#q1-child").hide();
			$("#info-box,.adult-row").show();
			$("tr").removeClass("selected");
			if($("#adults-array-count").val()>0) {
				$(".nav-next,#add-adult-button").show();
			} else {
				$("#add-row,#fn-field,#mi-field,#ln-field").show();
				$("#fn-field").focus();
			}
		});
		$( ".option" ).click(function() {
			if ($(this).attr("id") == "q1-child") {
				$(this).addClass("selected");
				$("#q1-adult").removeClass("selected");
				$("#adult").val("0");
			} else if ($(this).attr("id") == "q1-adult") {
				$(this).addClass("selected");
				$("#q1-child").removeClass("selected");
				$("#adult").val("1");
			}
			$( "#save2" ).show();
		});
	});
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<h2>All Other Household Members</h2>
<div id="info-box" style="font-size:16px; text-align:left; margin-bottom: 5px;">
<b><u>Include in this section</u>:</b><ul><li>Anyone in the household who is NOT applying for free or reduced price school meals (including infants, children, and yourself if applicable)</li><li>Anyone in the household who shares income and expenses, even if not related, and even if they do not have income of their own</li></ul><b><u>Do not include in this section</u>:</b><ul><li>Anyone who is not supported by the household's income and does not contribute income to your household</li><li>Any students already listed in the previous section</li></ul>
</div>
<form action="add_hh_member_process.php" method="post">
<input type="hidden" name="selected" id="selected"
<?php
if(isset($_GET['editId'])) {
	echo(' value="'.$_GET['editId'].'"');
}
?>
 />
<input type="hidden" name="edit-in-progress" id="edit-in-progress"
<?php
if(isset($_GET['editId'])) {
	echo(' value="1"');
}
?>
 />
<input type="hidden" name="add-in-progress" id="add-in-progress" />
<input type="hidden" name="adult" id="adult" />
<input type="hidden" id="adults-array-count" value="
<?php
echo(count($_SESSION['adults']));
?>
" />
<table class="persons" id="table"
<?php
if(count($_SESSION['adults'])==0){
	echo(' style="display:none;"');
}
?>
>
<tr><th style="text-align:left;width:35%">First</th>
<th style="text-align:left;width:10%">MI</th>
<th style="text-align:left;width:55%">Last</th>
</tr>
<tr><th colspan="3" style="text-align:left;"><span style="font-size:14px;">Click or tap a name to select</span></th></tr>
<?php
$_SESSION['adults'] = array_values($_SESSION['adults']);
foreach($_SESSION['adults'] as $key=>$value) {
	echo('<tr tabindex="1" id="'.$key.'" class="adult-row" data-adult="'.$value[4].'"');
	if((isset($_GET['editId']))&&($key == $_GET['editId'])) {
		echo(' style="display:none;"');
		$fn = $value[1];
		$mi = $value[2];
		$ln = $value[3];
		$adult = $value[4];
	}
	echo('><td style="width:35%">'.$value[1].'</td><td style="width:10%">'.$value[2].'</td><td style="width:55%">'.$value[3].'</td></tr>');
}
echo('<tr><td id="add-row" colspan="3" style="text-align:center;');
if(!isset($_GET['editId'])){
	echo('display:none;');
}
echo('"><input name="fn" id="fn-field" type="text" style="width:35%;');
if(!isset($_GET['editId'])){
	echo('display:none;');
}
echo('" placeholder="First name"');
if(isset($_GET['editId'])) {
	echo(' value="'.$fn.'"');
}
echo(' autocomplete="off" /><input name="mi" id="mi-field" type="text" size="2" style="width:10%;');
if(!isset($_GET['editId'])){
	echo('display:none;');
}
echo('" placeholder="MI"');
if(isset($_GET['editId'])) {
	echo(' value="'.$mi.'"');
}
echo(' autocomplete="off" maxlength="1" /><input name="ln" id="ln-field" type="text" style="width:55%;');
if(!isset($_GET['editId'])){
	echo('display:none;');
}
echo('" placeholder="Last name"');
if(isset($_GET['editId'])) {
	echo(' value="'.$ln.'"');
}
echo(' autocomplete="off" /><button id="cancel1" tabindex="3" style="width:45%;display:none;" class="cancel" onClick="return false;"><i class="fa fa-times"></i> Cancel</button><button name="save1" onClick="return false;" id="save1" tabindex="3" style="width:45%;display:none;" class="add"><i class="fa fa-check"></i> Save</button><span id="q1" style="font-weight:bold;');
if (!isset($_GET['editId'])) {
	echo('display:none;');
}
echo('">Is <span id="q1-name" style="text-decoration:underline;">');
if(isset($_GET['editId'])) {
	echo($fn);
}
echo('</span> an Adult or a Child?<br /></span><button style="width:45%;');
if (!isset($_GET['editId'])) {
	echo('display:none;');
}
echo('" tabindex="1" id="q1-adult" class="option');
if(isset($_GET['editId']) && $adult==1) {
	echo(' selected');
}
echo('" onClick="return false;">Adult</button><button style="width:45%;');
if (!isset($_GET['editId'])) {
	echo('display:none;');
}
echo('" tabindex="2" id="q1-child" class="option');
if(isset($_GET['editId']) && $adult==0) {
	echo(' selected');
}
echo('" onClick="return false;">Child</button><br /><button id="cancel2" tabindex="3" style="width:45%;');
if (!isset($_GET['editId'])) {
	echo('display:none;');
}
echo('" class="cancel" onClick="return false;"><i class="fa fa-times"></i> Cancel</button><button type="submit" id="save2" name="save2" tabindex="3" style="width:45%;display:none;" class="add" ><i class="fa fa-check"></i> Save</button></td></tr>');
?>
</table><button tabindex="2" class="add" id="edit" onClick="return false;" style="width:45%;display:none;"><i class="fa fa-pencil" ></i> Edit</button><button name="delete" tabindex="2" class="delete" id="delete" onclick="return confirm('Are you sure you want to remove this household member?');" style="width:45%;display:none;"><i class="fa fa-ban" ></i> Remove</button>
<button tabindex="3" class="add" onClick="return false;" id="add-adult-button"
<?php
if(isset($_GET['editId'])){
	echo(' style="display:none;"');
}
?>
><i class="fa fa-plus"></i> Add Household Member</button>
</div>
<button tabindex="5" class="nav-prev" onClick="parent.location='add_student.php'; return false;"><i class="fa fa-arrow-left"></i><br />Previous<br />Step</button>
<button type="submit" tabindex="4" class="nav-next"
<?php
if(isset($_GET['editId'])){
	echo(' style="display:none;"');
}
?>
><i class="fa fa-arrow-right"></i><br />Next<br />Step</button>
</form>
<?php include('footer.php'); ?>
</body>
</html>