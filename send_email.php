<?php
session_start();
$longApp_ID = str_pad($_SESSION['App_ID'],12,'0',STR_PAD_LEFT);
$subject = "National School Lunch Program - Application Confirmation";
$txt = "Your application for free and reduced price lunches has been processed.\n\nYour confirmation number is:\n".substr($longApp_ID,0,4)."-".substr($longApp_ID,4,4)."-".substr($longApp_ID,8,4)."\n\nPlease contact your school directly for application status.\n\nThis email is sent from an automated system and will not accept incoming messages.";
$headers = "From: no-reply@valencia-lunchux.netai.net";
mail($_GET['email'],$subject,$txt,$headers);
echo($_GET['email']);
?> 