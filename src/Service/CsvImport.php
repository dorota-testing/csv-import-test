<?php

namespace Service;

class CsvImport
{
  /**
   * This reads csv file and turns each line into an assoc array 
   * First line is assumed to be column names and is used for keys in arrays
   * Empty lines are skipped
   * @param string - path to the csv file (example: 'tests/testFiles/productSample.csv')
   * @return array - array of product arrays
   */
	public function turn_csv_file_into_array(string $csv_path)
	{
		$arrReturn = [];
		$file = new \SplFileObject($csv_path, "r");
		$n = 0;
		while (!$file->eof()) {
			$n++;
			if ($n === 1) {
        // use first line as names of array keys
				$arrColNames = $file->fgetcsv();
			}
			if ($n > 1) {
				$arrLine = $file->fgetcsv();
				// echo $n; print_r($arrLine); echo'<br>';
				// check if line not empty
				$implode = implode('', $arrLine);
				if (!empty($implode)) {
					// echo 'not empty<br>';
					foreach ($arrColNames as $k => $colName) {
            // if there is no value in line for a key in array, it will be empty
						$arr[$colName] = (isset($arrLine[$k]) ? $arrLine[$k] : '');
					}
					$arrReturn[] = $arr;
				}
			}
		}
		return $arrReturn;
	}
}
