<?php
	
	$insertJobTableSQL = $SQL_INSERT . $jobTableName . ' (job_id, start_time, end_time, ip_address) VALUES (\'' . $jobID . '\', \'' . $startTime . '\', \'' . $endTime . '\', \'' . $ipAddress . '\')';
	mysqli_query($DATABASE_LINK, $insertJobTableSQL);
	
?>