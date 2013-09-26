<?php
	
	$updateJobSQL = $SQL_UPDATE . $jobTableName . ' SET end_time=' . '\'' . $endTime . '\'' . ' WHERE job_id=' . '\'' . $jobID . '\'';
	mysqli_query($DATABASE_LINK, $updateJobSQL);

?>