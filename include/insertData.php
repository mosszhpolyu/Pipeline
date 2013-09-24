<?php
	
	// insert gene name and probe id to table
	include('./include/insertGeneName.php');
	
	// insert sample ID, gene name, and gene expression value to table
	for($i = 0; $i < sizeof($expressionData); $i++) {
		include('./include/insertExpression.php');
	}

?>