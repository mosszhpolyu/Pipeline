<?php
	
	$insertExpressionSQL = $SQL_INSERT . $expressionTableName . ' (gene_name, sample_id, expression_level) VALUES (\'' . $geneData[0] . '\', \'' . $sampleId[$i] . '\', \'' . $expressionData[$i] . '\')';
	mysqli_query($DATABASE_LINK, $insertExpressionSQL);

?>