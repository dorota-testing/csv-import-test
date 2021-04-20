<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\DorotasClass;

class DorotasTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testSayHello()
    {
        $objDorota = new DorotasClass();
        $hello = $objDorota->sayHello();

        $this->assertTrue($hello === 'Hello');
    }
}
