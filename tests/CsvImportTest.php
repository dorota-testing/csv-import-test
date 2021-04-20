<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Service\CsvImport;

class CsvImportTest extends TestCase
{

    /**
     * This tests import of sample csv files.
     *
     * @return void
     */

    public function testTurnCsvIntoArray()
    {
        $objCsvImport = new CsvImport();

        //check empty
        $arrCSVempty = $objCsvImport->turn_csv_file_into_array('tests/testFiles/empty.csv');
        $emptyArr = [];
        $this->assertSame($arrCSVempty, $emptyArr);

        //check five lines file
        $arrCSVfive = $objCsvImport->turn_csv_file_into_array('tests/testFiles/fiveLines.csv');
        $arrFiveLines = [
            ['title' => 'line one'],
            ['title' => 'line two'],
            ['title' => 'line three'],
            ['title' => 'line four'],
            ['title' => 'line five'],
        ];
        $this->assertSame($arrCSVfive, $arrFiveLines);
    }

    /**
     * This tests a sample file of 4 products
     */
    public function testProductSample()
    {
        $objCsvImport = new CsvImport();

        $arrResult = [
            [
                'Product Code' => 'T0001',
                'Product Name' => 'TV',
                'Product Description' => '32” Tv',
                'Stock' => '10',
                'Cost in GBP' => '1000.99',
                'Discontinued' => ''
            ],
            [
                'Product Code' => 'T0002',
                'Product Name' => 'Cd Player',
                'Product Description' => 'Nice CD player',
                'Stock' => '11',
                'Cost in GBP' => '50.12',
                'Discontinued' => 'yes'
            ],
            [
                'Product Code' => 'T0003',
                'Product Name' => 'VCR',
                'Product Description' => 'Top notch VCR',
                'Stock' => '9',
                'Cost in GBP' => '4.33',
                'Discontinued' => 'yes'
            ],
            [
                'Product Code' => 'T0011',
                'Product Name' => 'Misc Cables',
                'Product Description' => 'error in export',
                'Stock' => '',
                'Cost in GBP' => '',
                'Discontinued' => ''
            ]

        ];
        //check empty
        $arrCSV = $objCsvImport->turn_csv_file_into_array('tests/testFiles/productSample.csv');
        //echo '<pre>';
        //print_r($arrCSV);

        $this->assertSame($arrCSV, $arrResult);
    }
}
