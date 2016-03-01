<table class="progress"><tr style="border:0;">
<?php

for($i=0;$i<8;$i++) {
	if($i>0) {
		echo('<td class="caret');
			if($i < $currStep) {
				echo('-complete');
			}
		echo('"><i class="fa fa-caret-right fa-lg"></i></td>');
		if($i==3 && isset($_SESSION['FASTRACK']) && $_SESSION['FASTRACK'] == 1) {
			for($k=0;$k<2;$k++) {
				echo('<td class="caret');
				if($i < $currStep) {
					echo('-complete');
				}
				echo('"><i class="fa fa-caret-right fa-lg"></i></td>');
			}
		}
	}

	if($i!=3 || !isset($_SESSION['FASTRACK']) || (isset($_SESSION['FASTRACK']) && $_SESSION['FASTRACK'] != 1)) {
		echo('<td class="step');
		if($i < $currStep) {
			echo('-complete');
		} elseif ($i < $_SESSION['maxStep']) {
			echo('-complete-gray');
		}
		echo('"');
		if($i < $_SESSION['maxStep']) {
			echo(' onclick="location.href=\'');
			if ($i==0) {
				echo('certify.php');
			} elseif ($i==1) {
				echo('case.php');
			} elseif ($i==2) {
				echo('add_student.php');
			} elseif ($i==3) {
				echo('add_hh_member.php');
			} elseif ($i==4) {
				echo('optional.php');
			} elseif ($i==5) {
				echo('contact.php');
			} elseif ($i==6) {
				echo('signature.php');
			} elseif ($i==7) {
				echo('confirmation.php');
			}
			echo('\'"');
		}
		echo('>');
		if ($i==0) {
			echo('Certification<br />Statement');
		} elseif ($i==1) {
			echo('Household<br />Status');
		} elseif ($i==2) {
			echo('Students');
		} elseif ($i==3) {
			echo('Other Household Members');
		} elseif ($i==4) {
			echo('Race &<br />Ethnicity');
		} elseif ($i==5) {
			echo('Contact<br />Information');
		} elseif ($i==6) {
			echo('Review &<br />Sign');
		} elseif ($i==7) {
			echo('Application<br />Complete');
		}
		echo('</td>');
	}
}
?>
</tr></table>