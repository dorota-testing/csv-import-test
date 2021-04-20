<?php

namespace Tests;
require_once __DIR__ . '/../bootstrap.php';
use PHPUnit\Framework\TestCase;
use Service\Database;

class DatabaseTest extends TestCase
{
    /** 
     * This sets database connection
     * @return Databae
     */
    public function makeDatabase()
    {
        $arrConfig = json_decode(file_get_contents('config.json'), true);
        $database = new Database($arrConfig);
        return $database;
    }

    /** 
     * This tests database connection
     * @return void
     */
    public function testItConnectsToTheDatabase()
    {
        $database = $this->makeDatabase();
        $this->assertTrue($database->error === null);
    }


}
