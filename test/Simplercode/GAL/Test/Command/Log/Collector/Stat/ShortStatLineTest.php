<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Stat;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\Stat\ShortStatLine;

class ShortStatLineTest extends TestCase
{
    /**
     * @var ShortStatLine
     */
    protected $collector;

    protected function setUp(): void
    {
        $this->collector = new ShortStatLine();
    }

    public static function getLineExamples()
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
