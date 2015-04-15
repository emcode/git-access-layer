<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Stat;

use PHPUnit_Framework_TestCase;
use Simplercode\GAL\Command\Log\Collector\Stat\ShortStatLine;
use Simplercode\GAL\Command\Log\Collector\Stat\ShortStatValues;

class ShortStatLineTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ShortStatLine
     */
    protected $collector;

    protected function setUp()
    {
        $this->collector = new ShortStatLine();
    }

    public function getLineExamples()
    {
        $data = array();

        foreach(ShortStatFixture::$lineExamples as $lines => $result)
        {
            $data[] = array($lines, $result);
        }

        return $data;
    }

    /**
     * @dataProvider getLineExamples
     */
    public function testStatLineIsExtractedCorrectlyFromMultipleLines($commitLines, $expectedResult)
    {
        $realResult = $this->collector->collect($commitLines);
        $this->assertEquals($expectedResult, $realResult);
    }
}