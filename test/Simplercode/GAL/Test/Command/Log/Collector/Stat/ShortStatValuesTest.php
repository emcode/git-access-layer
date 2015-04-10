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
        $exampleLines = array_keys(ShortStatValuesFixture::$examples);
        $data = array();

        foreach($exampleLines as $line)
        {
            $data[] = array($line);
        }

        return $data;
    }

    /**
     * @dataProvider getSingleLineExamples
     */
    public function testStatValuesIsExtractedCorrectlyFromSingleLine($line)
    {
        if (!isset(ShortStatValuesFixture::$examples[$line]))
        {
            throw new \InvalidArgumentException(sprintf(
                'Received line that does not exist in fixtures: %s', $line
            ));
        }

        $expectedResult = ShortStatValuesFixture::$examples[$line];
        $realResult = $this->collector->collect($line);
        $this->assertEquals($expectedResult, $realResult);
    }
}