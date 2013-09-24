<?php
	
	$insertGeneTableSQL = $SQL_INSERT . $geneTableName . ' (gene_name, probe_id) VALUES (\'' . $geneData[0] . '\', \'' . $geneData[1] . '\')';
	mysqli_query($DATABASE_LINK, $insertGeneTableSQL);

?>