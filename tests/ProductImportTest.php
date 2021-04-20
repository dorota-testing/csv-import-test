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
    /**
     * This sets data for next test
     */
    public function getSingleProductData()
    {
        return [
            [
                '1',
                [
                    'status' => 'skipped_over',
                    'comment' => ''
                ],
                [
                    'Product Code' => 'T0001',
                    'Product Name' => 'TV',
                    'Product Description' => '32” Tv',
                    'Stock' => '10',
                    'Cost in GBP' => '1000.99',
                    'Discontinued' => ''
                ],
            ],
            [
                '2',
                [
                    'status' => 'successful',
                    'comment' => ''
                ],
                [
                    'Product Code' => 'T0002',
                    'Product Name' => 'Cd Player',
                    'Product Description' => 'Nice CD player',
                    'Stock' => '11',
                    'Cost in GBP' => '50.12',
                    'Discontinued' => 'yes'
                ]
            ],
            [
                '3',
                [
                    'status' => 'skipped_error',
                    'comment' => '* csv file line 3, product code: T0011',
                ],
                [
                    'Product Code' => 'T0011',
                    'Product Name' => 'Misc Cables',
                    'Product Description' => 'error in export',
                    'Stock' => '',
                    'Cost in GBP' => '',
                    'Discontinued' => ''
                ]
            ],
            [
                '4',
                [
                    'status' => 'skipped_less',
                    'comment' => '',
                ],
                [
                    'Product Code' => 'T0022',
                    'Product Name' => 'Lorem',
                    'Product Description' => 'Lorem ipsum',
                    'Stock' => '5',
                    'Cost in GBP' => '4',
                    'Discontinued' => ''
                ]
            ]
        ];
    }

    /**
     * @dataProvider getSingleProductData
     */
    public function testAnalyseProductArray(string $lineNo, array $report, array $product)
    {

        $container = $this->makeContainer();
        $objImportProduct = $container->getProductImport();
        $arrResult = $objImportProduct->analyseProductArray($product, $lineNo);

        $this->assertSame($arrResult, $report);
    }

    /**
     * This tests processing of whole array of products.
     * @return void
     */
    public function testProcessImportFile()
    {
        $path_csv = 'tests/testFiles/productSample.csv';
        $container = $this->makeContainer();
        $objImportProduct = $container->getProductImport();
        $result = $objImportProduct->processImportFile($path_csv);
        $report = $result['report'];
        $products = $result['products'];

        // delete the products just inserted in the db
        $database = $container->getDatabase();
        foreach ($products as $prod) {
            $database->query("DELETE FROM tbl_product_data WHERE strProductCode = :code");
            $database->bind(':code', $prod->getCode());
            $database->execute();
        }
        // check that valid object Report was returned
        $this->assertTrue(is_numeric($report->getTotalItems()));
        $this->assertTrue(is_numeric($report->getItemsSuccessful()));
        $this->assertTrue(is_numeric($report->getItemsSkippedError()));
        $this->assertTrue(is_numeric($report->getItemsSkippedOver()));
        $this->assertTrue(is_numeric($report->getItemsSkippedLess()));
        $this->assertTrue(is_numeric($report->getItemsDuplicate()));
    }
}
