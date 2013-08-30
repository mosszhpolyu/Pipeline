<?php
	// include class
	// specify class path
	require('./PHPExcel/Reader/Excel2007.php');
	require('db file path');

	// preapre to read Excel file
	$xlsxReader = PHPExcel_IOFactory::createReader('Excel2007');
	$xlsxReader->setReadDataOnly(true);
	$xlsxFile = $xlsxReader->load("test.xlsx");
	$currentSheet;

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

	// check if two worksheets have the same number of rows
	if(xlsxFile->setActiveSheetIndex(0)->getHighestRow() != xlsxFile->setActiveSheetIndex(1)->getHighestRow()) {
		// abort the execution
		// send error message
	} // end if

	// condition where they have the same number of rows
	else {
		// create table
		// call create table code here
		include('./createTable.php');

		// read data from normal and disease sheet
		// normal sheet as sheetIndex = 1
		// disease sheet as sheetIndex = 2
		for($sheetIndex = 0; $sheetIndex < $xlsxFile->getSheetCount(); $sheetIndex++) {
			$currentSheet = $xlsxFile->getSheet($sheetIndex);
			// read the dataset row by row
			for($currentRow = 0; $currentRow < $currentSheet->getHighestRow(); $currentRow++) {


				// first row is always sample_id
				// store these sample_id to array
				if($currentRow == 0) {
					switch ($sheetIndex) {
						case '0':
							for($currentCol = 0; $currentCol < $currentSheet->getHighestColumn(); $currentCol++) {
								$sampleIdNormal[$currentCol] = $currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getValue();
							}
							break;
					
						case '1':
							for($currentCol = 0; $currentCol < $currentSheet->getHighestColumn(); $currentCol++) {
								$sampleIdDisease[$currentCol] = $currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getValue();
							}
							break;

						default:
							# code...
							break;
					} // end switch
					//
				} // end if

				// for the rest of the rows
				// else read this row
				else {
					// starting from 2nd row, we read each cell and insert it to database
					for($currentCol = 0; $currentCol < $currentSheet->getHighestColumn(); $currentCol++) {
						// the first two columns are gene name and probe id
						// we store them in a temp array
						if($currentCol == 0 || $currentCol == 1) {
							$geneData[$currentCol] = $currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getValue();
						}
						// starting from 3rd column, it is the data
						else {
							$currentData = $currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getValue();
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
				} // end else
			} // end for, we now have all rows read in one worksheet
		} // end read sheet for, we now have both normal and disease data read and inserted to database
	} // end else checking if the have the same number of rows

	// need a way to do memory management
	// ???????????????????????????????????

	
?>