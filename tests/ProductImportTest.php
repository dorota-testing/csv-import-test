<?php

namespace Tests;

require_once __DIR__ . '/../bootstrap.php';

use PHPUnit\Framework\TestCase;
use Service\Container;

class ProductImportTest extends TestCase
{
    public function makeContainer()
    {
        $arrConfig = json_decode(file_get_contents('config.json'), true);
        $container = new Container($arrConfig);
        return $container;
    }

    /**
     * Test making objProduct
     */
    public function testCreateProductFromData()
    {
        $container = $this->makeContainer();
        $objImportProduct = $container->getProductImport();
        $arrProduct = [
            'Product Code' => 'P0001',
            'Product Name' => 'TV',
            'Product Description' => '32” Tv',
            'Stock' => '10',
            'Cost in GBP' => '399.99',
            'Discontinued' => ''
        ];
        $objProduct = $objImportProduct->createProductFromData($arrProduct);
        //echo '<pre>';
        //print_r($objProduct);

        $this->assertTrue($objProduct->getCode() == $arrProduct['Product Code']);
        $this->assertTrue($objProduct->getName() == $arrProduct['Product Name']);
        $this->assertTrue($objProduct->getDescription() == $arrProduct['Product Description']);
        $this->assertTrue($objProduct->getStock() == $arrProduct['Stock']);
        $this->assertTrue($objProduct->getPrice() == $arrProduct['Cost in GBP']);
        $this->assertTrue($objProduct->getDiscontinued() == $arrProduct['Discontinued']);
    }

    /**
     * Test saving product object in the db and deleting
     */
    public function testInsertAndDeleteProduct()
    {
        $container = $this->makeContainer();
        $objImportProduct = $container->getProductImport();

        $arrProduct = [
            'Product Code' => 'X0001',
            'Product Name' => 'TV',
            'Product Description' => '32” Tv',
            'Stock' => '10',
            'Cost in GBP' => '399.99',
            'Discontinued' => ''
        ];
        $objProduct = $objImportProduct->createProductFromData($arrProduct);

        //get the id
        $product_id = $objImportProduct->insertProduct($objProduct);

        $this->assertTrue($product_id > 0 && is_numeric($product_id));

        //delete product by id   

        $result = $objImportProduct->deleteProductById($product_id);

        $this->assertTrue($result == 1);
    }


}
