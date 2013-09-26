<?php
	
	$endTimeStamp = time();
	$endTime = date("Y-m-d H:i:s", $endTimeStamp);
	
	// update end time of current job
	include('./include/updateJob.php');
?>