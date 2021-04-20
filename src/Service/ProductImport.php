<?php

namespace Service;

use Model\Product;

class ProductImport
{

	private $database;
	private $arrConfig;
	private $csvImport;

	function __construct(array $arrConfig, Database $objDatabase, CsvImport $objCsvImport)
	{
		$this->database = $objDatabase;
		$this->arrConfig = $arrConfig;
		$this->csvImport = $objCsvImport;
	}

	public function sayHello()
	{
		return 'Hello';
	}

}
