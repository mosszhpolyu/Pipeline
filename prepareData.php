<?php
	// include class
	// specify class path
	require('./class/PHPExcel/Reader/Excel2007.php');

	// database connection file path
	require('./config.php');

	// create Job Id
	include('./include/createJob.php');

	// preapre to read Excel file
	$xlsxReader = PHPExcel_IOFactory::createReader('Excel2007');
	$xlsxReader->setReadDataOnly(true);
	//$xlsxFile = $xlsxReader->load("test.xlsx");
	$xlsxFile = $xlsxReader->load($_FILES["file"]["tmp_name"]);
	$currentSheet;

	// Regular expression patterns
	$PATTERN_NON_WHITE_SPACE = '/^[^\s]+$/';
	$PATTERN_SAMPLE_ID = '/^\w+$/';
	$PATTERN_GENE_NAME;
	$PATTERN_PROBE_ID;
	$PATTERN_EXPRESSION_VALUE;

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

	//////////////////////////////
	// variable to store current read value from excel
	//////////////////////////////
	$currentData;

	/////////////////////////////
	// array to store sample_ids, gene_jobID, and gene_expression table data
	/////////////////////////////
	$sampleId = array();
	$geneData = array();
	$expressionData = array();

	/////////////////////////////
	// variable to store current expression table name
	// either $expressionNormalTableName or $expressionDiseaseTableName
	/////////////////////////////
	$expressionTableName;

	// check if two worksheets have the same number of rows
	if($xlsxFile->setActiveSheetIndex('0')->getHighestRow() != $xlsxFile->setActiveSheetIndex('1')->getHighestRow()) {
		// abort the execution
		// send error message
	} // end if

	// condition where they have the same number of rows
	else {
		// create table
		include('./include/createTable.php');

		// insert current job information
		include('./include/insertJob.php');

		// read data from normal and disease sheet
		// normal sheet as sheetIndex = 1
		// disease sheet as sheetIndex = 2
		// row index starts from 1 aka first row on excel file
		// column index starts from A aka first column on excel file
		for($sheetIndex = 0; $sheetIndex < $xlsxFile->getSheetCount(); $sheetIndex++) {
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
						// Normal case
						case '0':
							$expressionTableName = $expressionNormalTableName;
							break;

						// Disease case
						case '1':
							$expressionTableName = $expressionDiseaseTableName;
							break;

						default:
							break;
					} // end switch

					// read each column of the current sample ID row
					for($currentColStr = 'A'; $currentColStr <= $currentSheet->getHighestColumn(); $currentColStr++) {
						// PHPExcel_Cell::columnIndexFromString($currentColStr) returns order of alphabet
						// A is 1
						// since column index starts from 0, we need to decrease one
						$currentCol = PHPExcel_Cell::columnIndexFromString($currentColStr) - 1;
						// get current cell's value
						$currentData = $currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getValue();
						// check if current value matches sample ID pattern
						if(preg_match($PATTERN_SAMPLE_ID, $currentData)) {
							//echo $currentData . ',';
							// add this sample ID to the array
							array_push($sampleId, $currentData);
						}
					} // end for
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
						$currentData = trim($currentSheet->getCellByColumnAndRow($currentCol, $currentRow)->getCalculatedValue());
						// the first two columns are gene name and probe id
						// we store them in a geneData array
						if($currentCol == 0 || $currentCol == 1) {
							array_push($geneData, $currentData);
						}
						// starting from 3rd column, it is the data
						else {
							array_push($expressionData, $currentData);
						}
					} // end for, we now have one row of data read
					include('./include/insertData.php');
					// reset geneData and expressionData arrays
					$geneData = array();
					$expressionData = array();
				}
				//echo "\n";
			} // end for, we now have all rows read in one worksheet
			// echo "<html><br></html>";
			// reset the sampleId array
			$sampleId = array();
		} // end read sheet for, we now have both normal and disease data read and inserted to database
	} // end else checking if the have the same number of rows

	// need a way to do memory management
	// ???????????????????????????????????

	// end task is house keeping
	include('./include/houseKeeping.php');
?>