<?php
	// constant SQL statement
	$SQL_SET_NAMES = "SET NAMES utf8; ";
	$SQL_SET_CHARACTER_CLIENT = "SET CHARACTER_SET_CLIENT = utf8; ";
	$SQL_SET_CHARACTER_RESULTS = "SET CHARACTER_SET_RESULTS = utf8; ";

	// database host, localhost in this case
	$HOST = "localhost";

	// database name
	$DATABASE_NAME = "pipe";

	// database username
	$USERNAME = "root";

	// database password
	// password file located \xampp\security\mysqlrootpasswd.txt
	$PASSWORD = "password";

	// establish database connection
	$DATABASE_LINK = mysqli_connect($HOST, $USERNAME, $PASSWORD);
	
	// abort if connection failed
	if($DATABASE_LINK) {
		// set character format
		mysqli_query($DATABASE_LINK, $SQL_SET_NAMES);
		mysqli_query($DATABASE_LINK, $SQL_SET_CHARACTER_CLIENT);
		mysqli_query($DATABASE_LINK, $SQL_SET_CHARACTER_RESULTS);

		// set current database
		mysqli_select_db($DATABASE_LINK, $DATABASE_NAME);
	}
	else {
		die('Could not connect: ' . mysqli_error());
		exit();
	}

?>