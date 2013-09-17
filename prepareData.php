<?php
	// include class
	// specify class path
	require('./class/PHPExcel/Reader/Excel2007.php');
	// database connection file path
	//require('db file path');

	// hard code job_id
	$jobID = '20130916';

	// preapre to read Excel file
	$xlsxReader = PHPExcel_IOFactory::createReader('Excel2007');
	$xlsxReader->setReadDataOnly(true);
	//$xlsxFile = $xlsxReader->load("test.xlsx");
	$xlsxFile = $xlsxReader->load($_FILES["file"]["tmp_name"]);
	$currentSheet;

	// Regular expression patterns
	$PATTERN_NON_WHITE_SPACE = '/^[^\s]+$/';
	$PATTERN_SAMPLE_ID;
	$PATTERN_GENE_NAME;
	$PATTERN_PROBE_ID;
	$PATTERN_EXPRESSION_VALUE;

	//////////////////////////////
	// create 5 tables
	// gene_jobID
	// expression_normal_jobID
	// expression_disease_jobID
	// correlation_normal_jobID
	// correlation_disease_jobID
	////////////////////////////////
	$geneTableName;
	$expressionNormalTableName;
	$expressionDiseaseTableName;
	$correlationNormalTableName;
	$correlationDiseaseTableName;

	///////////////////////////////
	// variables to store the highest row and column of the dataset
	///////////////////////////////
	$highestRow;
	$highestCol;

	//////////////////////////////
	// iterator to indicate current row and column
	//////////////////////////////
	$currentRow;
	$currentCol;

	/////////////////////////////
	// array to store sample_ids and gene_jobID table data
	/////////////////////////////
	$sampleIdNormal;
	$sampleIdDisease;
	$geneData;

	/////////////////////////////
	// variable to store current data read from Excel's current cell
	/////////////////////////////
	$currentData;
	//echo "helo". $xlsxFile->setActiveSheetIndex('0')->getHighestRow();
	//echo "good". $xlsxFile->setActiveSheetIndex('1')->getHighestRow();
	// check if two worksheets have the same number of rows
	if($xlsxFile->setActiveSheetIndex('0')->getHighestRow() != $xlsxFile->setActiveSheetIndex('1')->getHighestRow()) {
		// abort the execution
		// send error message
	} // end if

	// condition where they have the same number of rows
	else {
		// create table
		// call create table code here
		//include('./createTable.php');

		// read data from normal and disease sheet
		// normal sheet as sheetIndex = 1
		// disease sheet as sheetIndex = 2
		// row index starts from 1 aka first row on excel file
		// column index starts from A aka first column on excel file
		for($sheetIndex = 0; $sheetIndex < $xlsxFile->getSheetCount(); $sheetIndex++) {
			echo $sheetIndex;
			echo "<html><br></html>";
			$currentSheet = $xlsxFile->getSheet($sheetIndex);
			// read the dataset row by row
			// as first row is always header
			// we start iterate from second row. aka $currentRow = 1
			for($currentRow = 1; $currentRow <= $currentSheet->getHighestRow(); $currentRow++) {
				// we skip first row as it is column headers
				if($currentRow == 1) {
					continue;
				}
				// second row is always sample schema
				// store these sample_id to array
				else if($currentRow == 2) {
					switch ($sheetIndex) {
						case '0':
							for($currentColStr = 'A'; $currentColStr <= $currentSheet->getHighestColumn(); ++$currentColStr) {
								// PHPExcel_Cell::columnIndexFromString($currentColStr) returns order of alphabet
								// A is 1
								// since column index starts from 0, we need to decrease one
								$currentCol = PHPExcel_Cell::columnIndexFromString($currentColStr) - 1;
								// get current cell's value
								$sampleIdNormal[$currentCol] = $currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getValue();
								echo $sampleIdNormal[$currentCol] . ',';
							}
							break;
					
						case '1':
							for($currentColStr = 'A'; $currentColStr <= $currentSheet->getHighestColumn(); $currentColStr++) {
								// PHPExcel_Cell::columnIndexFromString($currentColStr) returns order of alphabet
								// A is 1
								// since column index starts from 0, we need to decrease one
								$currentCol = PHPExcel_Cell::columnIndexFromString($currentColStr) - 1;
								// get current cell's value
								$sampleIdDisease[$currentCol] = $currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getValue();
								echo $sampleIdDisease[$currentCol] . ',';
							}
							break;

						default:
							# code...
							break;
					} // end switch
					//
				} // end if

				// for the rest of the rows
				// read this row
				else {
					// starting from 3rd row, we read each cell and insert it to database
					for($currentColStr = 'A'; $currentColStr <= $currentSheet->getHighestColumn(); $currentColStr++) {
						// PHPExcel_Cell::columnIndexFromString($currentColStr) returns order of alphabet
						// A is 1
						// since column index starts from 0, we need to decrease one
						$currentCol = PHPExcel_Cell::columnIndexFromString($currentColStr) - 1;
						// the first two columns are gene name and probe id
						// we store them in a temp array
						if($currentCol == 0 || $currentCol == 1) {
							$geneData[$currentCol] = trim($currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getCalculatedValue());
							if(preg_match($PATTERN_NON_WHITE_SPACE, $geneData[$currentCol])) {
								echo $geneData[$currentCol] . ',';
							}
						}
						// starting from 3rd column, it is the data
						else {
							$currentData = trim($currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getCalculatedValue());
							if(preg_match($PATTERN_NON_WHITE_SPACE, $currentData)) {
								echo $currentData . ',';
							}
						}
						// code to insert into gene table
						// ?????????????????????????????
						// complete code here
						switch ($sheetIndex) {
							case '0':
								// insert into expressionNormalTable
								// ?????????????????????????????
								// complete code here
								break;
							case '1':
								// insert into expressionDiseaseble
								// ?????????????????????????????
								// complete code here
								break;
							default:
								# code...
								break;
						}
					} // end for, we now have one row of data inserted
				}
				echo "\n";
			} // end for, we now have all rows read in one worksheet
			echo "<html><br></html>";
		} // end read sheet for, we now have both normal and disease data read and inserted to database
	} // end else checking if the have the same number of rows

	// need a way to do memory management
	// ???????????????????????????????????

	
?>