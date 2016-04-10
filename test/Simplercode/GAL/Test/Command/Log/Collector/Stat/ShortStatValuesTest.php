<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Stat;

use PHPUnit_Framework_TestCase;
use Simplercode\GAL\Command\Log\Collector\Stat\ShortStatValues;

class ShortStatValuesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ShortStatValues
     */
    protected $collector;

    protected function setUp()
    {
        $this->collector = new ShortStatValues();
    }

    public function getSingleLineExamples()
    {
        $data = array();

        foreach(ShortStatFixture::$singlelineValueExamples as $line => $result)
        {
            $data[] = array($line, $result);
        }

        return $data;
    }

    /**
     * @dataProvider getSingleLineExamples
     */
    public function testStatValuesAreExtractedCorrectlyFromSingleLine($singleLine, $expectedResult)
    {
        $realResult = $this->collector->collect($singleLine);
        $this->assertEquals($expectedResult, $realResult);
    }

    public function getMultiLineExamples()
    {
        $data = array();

        foreach(ShortStatFixture::$multilineValueExamples as $lines => $result)
        {
            $data[] = array($lines, $result);
        }

        return $data;
    }

    /**
     * @dataProvider getMultiLineExamples
     */
    public function testStatValuesAreExtractedCorrectlyFromMultipleLines($commitLines, $expectedResult)
    {
        $realResult = $this->collector->collect($commitLines);
        $this->assertEquals($expectedResult, $realResult);
    }
}
