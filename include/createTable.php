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
	$geneTableSchema = '{' . $gene_name . 'VARCHAR(255)' . $probe_id . 'VARCHAR(255)' . ',' . '}';

	//////////////////////////////////
	// expressionNormal table
	// gene_name varchar(255), sample_id varchar(255), expression_level float
	//////////////////////////////////
	$expressionNormalTableSchema = '{' . $gene_name . 'VARCHAR(255)' . ',' . $sample_id . 'VARCHAR(255)' . $expression_level . 'FLOAT' . '}';

	//////////////////////////////////
	// expressionDisease table
	// gene_name varchar(255), sample_id varchar(255), expression_level float
	//////////////////////////////////
	$expressionDiseaseTableSchema = '{' . $gene_name . 'VARCHAR(255)' . ',' . $sample_id . 'VARCHAR(255)' . $expression_level . 'FLOAT' . '}';

	//////////////////////////////////
	// correlationNormal table
	// gene_name_1 varchar(255), gene_name_2 varchar(255), correlation_R float, correlation_P float
	//////////////////////////////////
	$correlationNormalTableSchema = '{' . $gene_name_1 . 'VARCHAR(255)' . ',' . $gene_name_2 . 'VARCHAR(255)' . ',' . $correlation_R . 'FLOAT' . ',' . $correlation_P . 'FLOAT' . '}';

	//////////////////////////////////
	// correlationDisease table
	// gene_name_1 varchar(255), gene_name_2 varchar(255), correlation_R float, correlation_P float
	//////////////////////////////////
	$correlationDiseaseTableSchema = '{' . $gene_name_1 . 'VARCHAR(255)' . ',' . $gene_name_2 . 'VARCHAR(255)' . ',' . $correlation_R . 'FLOAT' . ',' . $correlation_P . 'FLOAT' . '}';


	//////////////////////////////////
	// create tables SQL state
	//////////////////////////////////
	$geneTableSQL = 'CREATE TABLE' . $geneTableName . $geneTableSchema;
	$expressionNormalTableSQL = 'CREATE TABLE' . $expressionNormalTableName . $expressionNormalTableSchema;
	$expressionDiseaseTableSQL = 'CREATE TABLE' . $expressionDiseaseTableName . $expressionDiseaseTableSchema;
	$correlationNormalTableSQL = 'CREATE TABLE' . $correlationNormalTableName . $expressionNormalTableSchema;
	$correlationDiseaseTableSQL = 'CREATE TABLE' . $correlationDiseaseTableName . $expressionDiseaseTableSchema;

	/////////////////////////////////
	// alter table
	// add primary key, foreign key
	/////////////////////////////////


	/////////////////////////////////
	// execute the SQL statements
	/////////////////////////////////
	mysql_query($geneTableSQL);
	mysql_query($expressionNormalTableSQL);
	mysql_query($expressionDiseaseTableSQL);
	mysql_query($correlationNormalTableSQL);
	mysql_query($correlationDiseaseTableSQL);
?>