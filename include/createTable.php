<?php
	// Assign table names, which are identified by jobID
	$geneTableName = 'gene_' . $jobID;
	$expressionNormalTableName = 'expression_normal_' . $jobID;
	$expressionDiseaseTableName = 'expression_disease_' . $jobID;
	$correlationNormalTableName = 'correlation_normal_' . $jobID;
	$correlationDiseaseTableName = 'correlation_disease_' . $jobID;

	//////////////////////////////////
	// constant values for table schema
	//////////////////////////////////
	$probe_id = 'probe_id';
	$gene_name = 'gene_name';
	$sample_id = 'sample_id';
	$expression_level = 'expression_level';
	$probe1_id = 'probe1_id';
	$probe2_id = 'probe2_id';
	$correlation_R = 'correlation_R';
	$correlation_P = 'correlation_P';

	//////////////////////////////////
	// Table schema
	//////////////////////////////////

	//////////////////////////////////
	// gene_jobID table
	// probe_id varchar(255), gene_name varchar(255)
	//////////////////////////////////
	$geneTableSchema = '{' . $probe_id . 'varchar(255)' . ',' . $gene_name . 'varchar255' . '}';

	//////////////////////////////////
	// expressionNormal table
	// probe_id varchar(255), sample_id varchar(255), expression_level float
	//////////////////////////////////
	$expressionNormalTableSchema = '{' . $probe_id . 'varchar(255)' . ',' . $sample_id . 'varchar(255)' . $expression_level . 'float' . '}';

	//////////////////////////////////
	// expressionDisease table
	// probe_id varchar(255), sample_id varchar(255), expression_level float
	//////////////////////////////////
	$expressionDiseaseTableSchema = '{' . $probe_id . 'varchar(255)' . ',' . $sample_id . 'varchar(255)' . $expression_level . 'float' . '}';

	//////////////////////////////////
	// correlationNormal table
	// probe1_id varchar(255), probe2_id varchar(255), correlation_R float, correlation_P float
	//////////////////////////////////
	$correlationNormalTableSchema = '{' . $probe1_id . 'varchar(255)' . ',' . $probe2_id . 'varchar(255)' . ',' . $correlation_R . 'float' . ',' . $correlation_P . 'float' . '}';

	//////////////////////////////////
	// correlationDisease table
	// probe1_id varchar(255), probe2_id varchar(255), correlation_R float, correlation_P float
	//////////////////////////////////
	$correlationDiseaseTableSchema = '{' . $probe1_id . 'varchar(255)' . ',' . $probe2_id . 'varchar(255)' . ',' . $correlation_R . 'float' . ',' . $correlation_P . 'float' . '}';

	//////////////////////////////////
	// create tables SQL state
	//////////////////////////////////
	$geneTableSQL = 'CREATE TABLE' . $geneTableName . $geneTableSchema;
	$expressionNormalTableSQL = 'CREATE TABLE' . $expressionNormalTableName . $expressionNormalTableSchema;
	$expressionDiseaseTableSQL = 'CREATE TABLE' . $expressionDiseaseTableName . $expressionDiseaseTableSchema;
	$correlationNormalTableSQL = 'CREATE TABLE' . $correlationNormalTableName . $expressionNormalTableSchema;
	$correlationDiseaseTableSQL = 'CREATE TABLE' . $correlationDiseaseTableName . $expressionDiseaseTableSchema;

	/////////////////////////////////
	// execute the SQL statements
	/////////////////////////////////
	mysql_query($geneTableSQL);
	mysql_query($expressionNormalTableSQL);
	mysql_query($expressionDiseaseTableSQL);
	mysql_query($correlationNormalTableSQL);
	mysql_query($correlationDiseaseTableSQL);
?>