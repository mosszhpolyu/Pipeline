<?php

	require('./config.php');

	// constant SQL statement create table
	$SQL_CREATE_TABLE = 'CREATE TABLE ';
	
	// Assign table names, which are identified by jobID
	$geneTableName = $jobID . '_gene';
	$expressionNormalTableName = $jobID . '_expression_normal';
	$expressionDiseaseTableName = $jobID . '_expression_disease';
	$correlationNormalTableName = $jobID . '_correlation_normal';
	$correlationDiseaseTableName = $jobID . '_correlation_disease';

	//////////////////////////////////
	// constant values for table schema
	//////////////////////////////////
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
	$geneTableSQL = $SQL_CREATE_TABLE . $geneTableName . $geneTableSchema;
	$expressionNormalTableSQL = $SQL_CREATE_TABLE . $expressionNormalTableName . $expressionNormalTableSchema;
	$expressionDiseaseTableSQL = $SQL_CREATE_TABLE . $expressionDiseaseTableName . $expressionDiseaseTableSchema;
	$correlationNormalTableSQL = $SQL_CREATE_TABLE . $correlationNormalTableName . $expressionNormalTableSchema;
	$correlationDiseaseTableSQL = $SQL_CREATE_TABLE . $correlationDiseaseTableName . $expressionDiseaseTableSchema;

	/////////////////////////////////
	// alter table
	// add primary key, foreign key
	/////////////////////////////////


	/////////////////////////////////
	// execute the SQL statements
	/////////////////////////////////
	mysqli_query($DATABASE_LINK, $geneTableSQL);
	mysqli_query($DATABASE_LINK, $expressionNormalTableSQL);
	mysqli_query($DATABASE_LINK, $expressionDiseaseTableSQL);
	mysqli_query($DATABASE_LINK, $correlationNormalTableSQL);
	mysqli_query($DATABASE_LINK, $correlationDiseaseTableSQL);
?>