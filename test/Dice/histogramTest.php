<?php

namespace Ida\Dice;

use PHPUnit\Framework\TestCase;

class HistogramTest extends TestCase
{
    public function testGetSerie()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Ida\Dice\Histogram", $histogram);

        $res = $histogram->getSerie();
        $exp = null;

        $this->assertEquals($exp, $res);
    }
}
