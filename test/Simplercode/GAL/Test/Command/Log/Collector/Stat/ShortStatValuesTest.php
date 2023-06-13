<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Stat;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\Stat\ShortStatValues;

/**
 * @phpstan-type SingleTestCase array<string,int|null>
 * @phpstan-type TestCaseList array<int,array{string, SingleTestCase}>
 */
class ShortStatValuesTest extends TestCase
{
    /**
     * @var ShortStatValues
     */
    protected $collector;

    protected function setUp(): void
    {
        $this->collector = new ShortStatValues();
    }

    /**
     * @return TestCaseList
     */
    public static function getSingleLineExamples(): array
    {
        $data = [];

        foreach(ShortStatFixture::$singlelineValueExamples as $line => $result)
        {
            $data[] = [$line, $result];
        }

        return $data;
    }

    /**
     * @dataProvider getSingleLineExamples
     * @param SingleTestCase $expectedResult
     */
    public function testStatValuesAreExtractedCorrectlyFromSingleLine(string $singleLine, $expectedResult): void
    {
        $realResult = $this->collector->collect($singleLine);
        $this->assertEquals($expectedResult, $realResult);
    }

    /**
     * @return TestCaseList
     */
    public static function getMultiLineExamples(): array
    {
        $data = [];

        foreach(ShortStatFixture::$multilineValueExamples as $lines => $result)
        {
            $data[] = [$lines, $result];
        }

        return $data;
    }

    /**
     * @dataProvider getMultiLineExamples
     * @param SingleTestCase $expectedResult
     */
    public function testStatValuesAreExtractedCorrectlyFromMultipleLines(string $commitLines, $expectedResult): void
    {
        $realResult = $this->collector->collect($commitLines);
        $this->assertEquals($expectedResult, $realResult);
    }
}
