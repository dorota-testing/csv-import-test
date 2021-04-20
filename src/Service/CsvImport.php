<?php

namespace Service;

class CsvImport
{
	public function turn_csv_file_into_array(string $csv_path)
	{
		$arrReturn = [];
		$file = new \SplFileObject($csv_path, "r");
		$n = 0;
		while (!$file->eof()) {
			$n++;
			if ($n === 1) {
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
						$arr[$colName] = (isset($arrLine[$k]) ? $arrLine[$k] : '');
					}
					$arrReturn[] = $arr;
				}
			}
		}
		return $arrReturn;
	}
}
