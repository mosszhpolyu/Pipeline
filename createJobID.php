<?php
	// get timestamp
	$timeStamp = time();

	// generate 4-digit alphanumerical random string as salt
	$salt = substr(md5(rand()), 0, 4);

	// create seed (salt & timestamp) for generate 27-digit key
	$seed = $salt . $timeStamp;

	// generate 27-digit key, upper case only
	$key = strtoupper(uniqid($seed));

	// truncate first 4 and last 3 digit of key as jobID for user
	$part1 = substr($key, 0, strlen($salt));
	$part2 = substr($key, -3);
	$jobID = $part1 . $part2;

	echo "JOB ID: " . $jobID;
	echo "<html><br></html>";
	echo "<html><br></html>";
?>