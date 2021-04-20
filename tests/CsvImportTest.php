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

}
