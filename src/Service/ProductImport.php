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

	/** 
	 * this saves product in the db
	 * @param Product - expects object Product
	 * @return int last insert id
	 */
	public function insertProduct(Product $objProduct)
	{
		$this->database->query('INSERT INTO tbl_product_data ( 
			strProductName, strProductDesc,
			strProductCode, intStock,
			decPrice, dtmAdded,
			dtmDiscontinued
			) VALUES ( 
			:strProductName, :strProductDesc,
			:strProductCode, :intStock,
			:decPrice, NOW(),
			:dtmDiscontinued
			)');

		$params = array();
		$params[":strProductName"] = $objProduct->getName();
		$params[":strProductDesc"] = $objProduct->getDescription();
		$params[":strProductCode"] = $objProduct->getCode();
		$params[":intStock"] = $objProduct->getStock();
		$params[":decPrice"] = $objProduct->getPrice();
		$params[":dtmDiscontinued"] = ($objProduct->getDiscontinued() == 'yes' ? date("Y-m-d H:i:s") : NULL);

		$this->database->execute($params);

		// get the id
		$product_id = $this->database->lastInsertId();
		return $product_id;
	}
	/** 
	 * deletes product by id
	 */
	public function deleteProductById(int $id)
	{
		$result = '';
		if ($id > 0 && is_numeric($id)) {

			$this->database->query("DELETE FROM tbl_product_data WHERE intProductDataId = :id");
			$this->database->bind(':id', $id);
			$result = $this->database->execute();
		}
		return $result;
	}

	
}
