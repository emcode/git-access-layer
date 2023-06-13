<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Stat;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\Stat\ShortStatLine;

/**
 * @phpstan-type ExampleTestCases array<int,string[]>
 */
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

    /**
     * @return ExampleTestCases
     */
    public static function getLineExamples(): array
    {
        $data = [];

        foreach(ShortStatFixture::$lineExamples as $lines => $result)
        {
            $data[] = [$lines, $result];
        }

        return $data;
    }

    /**
     * @dataProvider getLineExamples
     */
    public function testStatLineIsExtractedCorrectlyFromMultipleLines(string $commitLines, string $expectedResult): void
    {
        $realResult = $this->collector->collect($commitLines);
        $this->assertEquals($expectedResult, $realResult);
    }
}
