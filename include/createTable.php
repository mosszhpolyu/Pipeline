<?php

	require('./config.php');

	// constant SQL statement create table
	$SQL_DESCRIBE = 'DESCRIBE ';
	$SQL_CREATE_TABLE = 'CREATE TABLE ';
	$SQL_INSERT = 'INSERT INTO ';
	$SQL_UPDATE = 'UPDATE ';

	// table name of jobID and connection information
	$jobTableName = 'job';
	
	// Assign table names, which are identified by jobID
	$geneTableName = $jobID . '_gene';
	$expressionNormalTableName = $jobID . '_expression_normal';
	$expressionDiseaseTableName = $jobID . '_expression_disease';
	$correlationNormalTableName = $jobID . '_correaltion_normal';
	$correlationDiseaseTableName = $jobID . '_correlation_disease';

	//////////////////////////////////
	// constant values for table schema
	//////////////////////////////////
	$job_id = 'job_id';
	$start_time = 'start_time';
	$end_time = 'end_time';
	$ip_address = 'ip_address';
	$probe_id = 'probe_id';
	$gene_name = 'gene_name';
	$sample_id = 'sample_id';
	$expression_level = 'expression_level';
	$gene_name_1 = 'gene_name_1';
	$gene_name_2 = 'gene_name_1';
	$correlation_R = 'correlation_R';
	$correlation_P = 'correlation_P';

	//////////////////////////////////
	// Table schema
	//////////////////////////////////

	//////////////////////////////////
	// job table
	// job_id varchar(255), start_time DATETIME, end_time DATETIME, ip_address VARCHAR(255)
	//////////////////////////////////
	$jobTableSchema = ' (' . $job_id . ' VARCHAR(255)' . ', ' . $start_time . ' DATETIME' . ', ' . $end_time . ' DATETIME' . ', '. $ip_address . ' VARCHAR(255)' . ')';
	
	//////////////////////////////////
	// gene_jobID table
	// probe_id varchar(255), gene_name varchar(255)
	//////////////////////////////////
	$geneTableSchema = ' (' . $gene_name . ' VARCHAR(255)' . ', ' . $probe_id . ' VARCHAR(255)' . ')';

	//////////////////////////////////
	// expressionNormal table
	// gene_name varchar(255), sample_id varchar(255), expression_level float
	//////////////////////////////////
	$expressionNormalTableSchema = ' (' . $gene_name . ' VARCHAR(255)' . ', ' . $sample_id . ' VARCHAR(255)' . ', ' . $expression_level . ' FLOAT' . ')';

	//////////////////////////////////
	// expressionDisease table
	// gene_name varchar(255), sample_id varchar(255), expression_level float
	//////////////////////////////////
	$expressionDiseaseTableSchema = ' (' . $gene_name . ' VARCHAR(255)' . ', ' . $sample_id . ' VARCHAR(255)' . ', ' . $expression_level . ' FLOAT' . ')';

	//////////////////////////////////
	// correlationNormal table
	// gene_name_1 varchar(255), gene_name_2 varchar(255), correlation_R float, correlation_P float
	//////////////////////////////////
	$correlationNormalTableSchema = ' (' . $gene_name_1 . ' VARCHAR(255)' . ', ' . $gene_name_2 . ' VARCHAR(255)' . ', ' . $correlation_R . ' FLOAT' . ', ' . $correlation_P . ' FLOAT' . ')';

	//////////////////////////////////
	// correlationDisease table
	// gene_name_1 varchar(255), gene_name_2 varchar(255), correlation_R float, correlation_P float
	//////////////////////////////////
	$correlationDiseaseTableSchema = ' (' . $gene_name_1 . ' VARCHAR(255)' . ', ' . $gene_name_2 . ' VARCHAR(255)' . ', ' . $correlation_R . ' FLOAT' . ', ' . $correlation_P . ' FLOAT' . ')';

	//////////////////////////////////
	// create tables SQL state
	//////////////////////////////////
	$describeJobTableSQL = $SQL_DESCRIBE . $jobTableName;
	$createJobTableSQL = $SQL_CREATE_TABLE . $jobTableName . $jobTableSchema;
	$createGeneTableSQL = $SQL_CREATE_TABLE . $geneTableName . $geneTableSchema;
	$createExpressionNormalTableSQL = $SQL_CREATE_TABLE . $expressionNormalTableName . $expressionNormalTableSchema;
	$createExpressionDiseaseTableSQL = $SQL_CREATE_TABLE . $expressionDiseaseTableName . $expressionDiseaseTableSchema;
	$createCorrelationNormalTableSQL = $SQL_CREATE_TABLE . $correlationNormalTableName . $expressionNormalTableSchema;
	$createCorrelationDiseaseTableSQL = $SQL_CREATE_TABLE . $correlationDiseaseTableName . $expressionDiseaseTableSchema;

	/////////////////////////////////
	// alter table
	// add primary key, foreign key
	/////////////////////////////////


	/////////////////////////////////
	// execute the SQL statements
	/////////////////////////////////
	// first time condition when the job table does not exist
	if(!mysqli_query($DATABASE_LINK, $describeJobTableSQL)) {
		mysqli_query($DATABASE_LINK, $createJobTableSQL);
	}
	mysqli_query($DATABASE_LINK, $createGeneTableSQL);
	mysqli_query($DATABASE_LINK, $createExpressionNormalTableSQL);
	mysqli_query($DATABASE_LINK, $createExpressionDiseaseTableSQL);
	mysqli_query($DATABASE_LINK, $createCorrelationNormalTableSQL);
	mysqli_query($DATABASE_LINK, $createCorrelationDiseaseTableSQL);
?>