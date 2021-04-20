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
	
	/** 
	 * this turns csv product into an object (fills in empty object Product form model class)
	 */
	public function createProductFromData(array $arrProduct)
	{
		$objProduct = new Product();
		$objProduct->setCode($arrProduct['Product Code']);
		$objProduct->setName($arrProduct['Product Name']);
		$objProduct->setDescription($arrProduct['Product Description']);
		$objProduct->setStock($arrProduct['Stock']);
		$objProduct->setPrice(preg_replace("/[^0-9.]/", "", $arrProduct['Cost in GBP'])); //strip non-numeric
		$objProduct->setDiscontinued($arrProduct['Discontinued']);
		return $objProduct;
	}
}
