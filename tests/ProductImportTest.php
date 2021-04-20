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
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
}
