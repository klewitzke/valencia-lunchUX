<?php
include('header.php');
if(!isset($_SESSION['children'])) {
	$_SESSION['children'] = array();
}

$currStep = 3;
if($_SESSION['maxStep'] < 3) {
	$_SESSION['maxStep'] = 3;
}
?>
<script>
	$(function() {
		$(".child-row").click(function() {
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
			if($("#"+id).attr("data-student")==1) {
				$("#q1-yes").addClass("selected");
			} else {
				$("#q1-no").addClass("selected");
			}
			if($("#"+id).attr("data-foster")==1) {
				$("#q2-opt2").addClass("selected");
			}
			if($("#"+id).attr("data-headstart")==1) {
				$("#q2-opt1").addClass("selected");
			}
			if($("#"+id).attr("data-homeless")==1) {
				$("#q2-opt3").addClass("selected");
			}
			if(($("#"+id).attr("data-foster")==0)&&($("#"+id).attr("data-headstart")==0)&&($("#"+id).attr("data-homeless")==0)) {
				$("#q2-opt4").addClass("selected");
			}
			$("#q1-name,#q2-name").html(fn);
			$("#delete,#edit,#add-child-button,.nav-next").hide();
			$("#"+id).hide();
			$("#add-row,#fn-field,#mi-field,#ln-field,#cancel2").show();
			if($("#case").val()==0) {
				$("#q2,#q2-opt1,#q2-opt2,#q2-opt3,#q2-opt4").show();
			}
		});
		$("#add-child-button").click(function() {
			$("#table,#add-row,#fn-field,#mi-field,#ln-field").show();
			$("#edit-in-progress").val("0");
			$("#add-in-progress").val("1");
			if($("#children-array-count").val()>0) {
				$("#cancel1").show();
			}
			$("#add-child-button,.nav-next").hide();
			$(".child-row").removeClass("selected");
			$("#delete,#edit").hide();
		});
		$( "#fn-field,#mi-field,#ln-field" ).keyup(function() {
			if (($("#fn-field").val().length>0)&&($("#ln-field").val().length>0)) {
				if($("#edit-in-progress").val()==1||$("#case").val()==1) {
					$("#save2" ).show();
				} else {
					$("#save1" ).show();
				}				
			} else {
				$( "#save1,#save2" ).hide();
			}
			if($("#q2-opt1").hasClass("selected")) {$("#headstart").val("1");} else {$("#headstart").val("0");}
			if($("#q2-opt2").hasClass("selected")) {$("#foster").val("1");} else {$("#foster").val("0");}
			if($("#q2-opt3").hasClass("selected")) {$("#homeless").val("1");} else {$("#homeless").val("0");}
		});
		$("#fn-field").blur(function() {
			var fn = $("#fn-field").val().toUpperCase();
			$("#q1-name,#q2-name").html(fn);
		});
		$("#cancel1").click(function() {
			$("#add-row,#cancel1").hide();
			$("#edit-in-progress,#add-in-progress").val("0");
			$("#add-child-button,.child-row").show();
			$("#fn-field,#mi-field,#ln-field").val("");
			if($("#children-array-count").val()>0) {
				$(".nav-next").show();
			}
		});
		$("#save1").click(function() {
			var fn = $("#fn-field").val().toUpperCase();
			var mi = $("#mi-field").val().toUpperCase();
			var ln = $("#ln-field").val().toUpperCase();
			$("<tr style=\"background-color:white;\"><td>" + fn + "</td><td>" + mi + "</td><td>" + ln + "</td></tr>").insertBefore($(this).closest("tr"));
			$("#fn-field,#mi-field,#ln-field,#cancel1,#save1").hide();
			$("#q1-name,#q2-name").html(fn);
			$("#q1,#q1-yes,#q1-no,#q2,#q2-opt1,#q2-opt2,#q2-opt3,#q2-opt4,#cancel2").show();
		});
		$("#cancel2").click(function() {
			$(this).closest("tr").prev().hide();
			$("#edit-in-progress,#add-in-progress").val("0");
			$("#fn-field,#mi-field,#ln-field").val("");
			$(".option").removeClass("selected");
			$("#add-row,#cancel2,#save2,#q1,#q1-yes,#q1-no,#q2,#q2-opt1,#q2-opt2,#q2-opt3,#q2-opt4").hide();
			$("#info-box,.child-row").show();
			$("tr").removeClass("selected");
			if($("#children-array-count").val()>0) {
				$(".nav-next,#add-child-button").show();
			} else {
				$("#add-row,#fn-field,#mi-field,#ln-field").show();
				$("#fn-field").focus();
			}
		});
		$( ".option" ).click(function() {
			if (($(this).attr("id") == "q2-opt1")||($(this).attr("id") == "q2-opt2")||($(this).attr("id") == "q2-opt3")) {
				$(this).toggleClass("selected");
				if(($("#q2-opt1").hasClass("selected"))||($("#q2-opt2").hasClass("selected"))||($("#q2-opt3").hasClass("selected"))) {
					$("#q2-opt4").removeClass('selected');
				} else {
					$("#q2-opt4").addClass('selected');
				}
			} else if ($(this).attr("id") == "q2-opt4") {
				$(this).addClass('selected');
				$("#q2-opt1").removeClass('selected');
				$("#q2-opt2").removeClass('selected');
				$("#q2-opt3").removeClass('selected');
			}
			if($("#q2-opt1").hasClass("selected")) {$("#headstart").val("1");} else {$("#headstart").val("0");}
			if($("#q2-opt2").hasClass("selected")) {$("#foster").val("1");} else {$("#foster").val("0");}
			if($("#q2-opt3").hasClass("selected")) {$("#homeless").val("1");} else {$("#homeless").val("0");}
			if( ($("#q2-opt1").hasClass("selected")||$("#q2-opt2").hasClass("selected")||$("#q2-opt3").hasClass("selected")||$("#q2-opt4").hasClass("selected"))) {
				$( "#save2" ).show();
			}
		});
	});
</script>
</head>
<body>
<?php include('progress_bar.php'); ?>
<div id="main-container">
<div id="main">
<h2>Students Applying for Free or Reduced Price School Meals</h2>
<div id="info-box" style="font-size:16px; text-align:left; margin-bottom:5px;">
<b><u>Include in this section</u>:</b><ul><li>All students in your household attending high school grade 12 or under, who are applying for free or reduced price school meals</li><li>Any child in your care under a foster arrangement, or that qualifies as homeless, migrant, or runaway youth</li></ul>
</div>
<form id="form" action="add_student_process.php" method="post">
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
<input type="hidden" name="case" id="case" value="<?php echo($_SESSION['case']); ?>" />
<input type="hidden" name="add-in-progress" id="add-in-progress" />
<input type="hidden" name="headstart" id="headstart" />
<input type="hidden" name="homeless" id="homeless" />
<input type="hidden" name="foster" id="foster" />
<input type="hidden" id="children-array-count" value="
<?php
echo(count($_SESSION['children']));
?>
" />
<table class="persons" id="table">
<tr><th style="text-align:left;width:35%">First<br /></th>
<th style="text-align:left;width:10%">MI</th>
<th style="text-align:left;width:55%">Last</th>
</tr>
<tr><th colspan="3" style="text-align:left;"><span style="font-size:14px;">Click or tap a name to select</span></th></tr>
<?php
$_SESSION['children'] = array_values($_SESSION['children']);
foreach($_SESSION['children'] as $key=>$value) {
	echo('<tr tabindex="1" id="'.$key.'" class="child-row" data-foster="'.$value[4].'" data-headstart="'.$value[5].'" data-homeless="'.$value[6].'"');
	if((isset($_GET['editId']))&&($key == $_GET['editId'])) {
		echo(' style="display:none;"');
		$fn = $value[1];
		$mi = $value[2];
		$ln = $value[3];
		$foster = $value[4];
		$headstart = $value[5];
		$homeless = $value[6];
	}
	echo('><td style="width:35%">'.$value[1].'</td><td style="width:10%">'.$value[2].'</td><td style="width:55%">'.$value[3].'</td></tr>');
}
echo('<tr><td id="add-row" colspan="3" style="text-align:center;');
if((count($_SESSION['children'])>0)&&(!isset($_GET['editId']))){
	echo('display:none;');
}
echo('"><input name="fn" id="fn-field" type="text" style="width:35%;');
if((count($_SESSION['children'])>0)&&(!isset($_GET['editId']))){
	echo('display:none;');
}
echo('" placeholder="First name"');
if(isset($_GET['editId'])) {
	echo(' value="'.$fn.'"');
}
echo(' autocomplete="off" /><input name="mi" id="mi-field" type="text" size="2" style="width:10%;');
if((count($_SESSION['children'])>0)&&(!isset($_GET['editId']))){
	echo('display:none;');
}
echo('" placeholder="MI"');
if(isset($_GET['editId'])) {
	echo(' value="'.$mi.'"');
}
echo(' autocomplete="off" maxlength="1" /><input name="ln" id="ln-field" type="text" style="width:55%;');
if((count($_SESSION['children'])>0)&&(!isset($_GET['editId']))){
	echo('display:none;');
}
echo('" placeholder="Last name"');
if(isset($_GET['editId'])) {
	echo(' value="'.$ln.'"');
}
echo(' autocomplete="off" /><button id="cancel1" tabindex="3" style="width:45%;display:none;" class="cancel" onClick="return false;"><i class="fa fa-times"></i> Cancel</button><button id="save1" tabindex="3" style="width:45%;display:none;" class="add" onClick="return false;"><i class="fa fa-check"></i> Save</button><span id="q2" style="font-weight:bold;');
if (!isset($_GET['editId'])||$_SESSION['case']==1) {
	echo('display:none;');
}
echo('">Do any of the following apply to <span id="q2-name" style="text-decoration:underline;">');
if(isset($_GET['editId'])) {
	echo($fn);
}
echo('</span>?</b><br /></span><button tabindex="1" id="q2-opt1" class="option');
if(isset($_GET['editId']) && $headstart==1) {
	echo(' selected');
}
echo('"');
if (!isset($_GET['editId'])||$_SESSION['case']==1) {
	echo(' style="display:none;"');
}
echo(' onClick="return false;">Head Start</button><button tabindex="2" id="q2-opt2" class="option');
if(isset($_GET['editId']) && $foster==1) {
	echo(' selected');
}
echo('"');
if (!isset($_GET['editId'])||$_SESSION['case']==1) {
	echo(' style="display:none;"');
}
echo(' onClick="return false;">Foster Child</button><button tabindex="3" id="q2-opt3" class="option');
if(isset($_GET['editId']) && $homeless==1) {
	echo(' selected');
}
echo('"');
if (!isset($_GET['editId'])||$_SESSION['case']==1) {
	echo(' style="display:none;"');
}
echo(' onClick="return false;">Homeless, Migrant<br />or Runaway</button><button tabindex="4" id="q2-opt4" class="option');
if(isset($_GET['editId']) && $headstart==0 && $foster==0 && $homeless==0) {
	echo(' selected');
}
echo('"');
if (!isset($_GET['editId'])||$_SESSION['case']==1) {
	echo(' style="display:none;"');
}
echo(' onClick="return false;">None of the above</button><br /><button id="cancel2" tabindex="3" style="width:45%;');
if (!isset($_GET['editId'])) {
	echo('display:none;');
}
echo('" class="cancel" onClick="return false;"><i class="fa fa-times"></i> Cancel</button><button type="submit" id="save2" name="save2" tabindex="3" style="width:45%;display:none;" class="add" ><i class="fa fa-check"></i> Save</button></td></tr>');
?>
</table><button tabindex="2" class="add" id="edit" onClick="return false;" style="width:45%;display:none;"><i class="fa fa-pencil" ></i> Edit</button><button name="delete" tabindex="2" class="delete" id="delete" onclick="return confirm('Are you sure you want to remove this child?');" style="width:45%;display:none;"><i class="fa fa-ban" ></i> Remove</button>
<button tabindex="3" class="add" onClick="return false;" id="add-child-button"
<?php
if((count($_SESSION['children'])==0)||(isset($_GET['editId']))){
	echo(' style="display:none;"');
}
?>
><i class="fa fa-plus"></i> Add Student</button>
</div>
<button tabindex="5" class="nav-prev" onClick="parent.location='case.php'; return false;"><i class="fa fa-arrow-left"></i><br />Previous<br />Step</button>
<?php
if(count($_SESSION['children'])>0) {
	echo('<button tabindex="4" class="nav-next" onClick="parent.location=\'add_student_process.php\'; return false;"');
	if(isset($_GET['editId'])){
		echo(' style="display:none;"');
	}
	echo('><i class="fa fa-arrow-right"></i><br />Next<br />Step</button>');
}
?>
</form>
<?php include('footer.php'); ?>
</body>
</html>