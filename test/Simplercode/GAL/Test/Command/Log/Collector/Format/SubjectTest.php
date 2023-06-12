<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\Format\Subject;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class SubjectTest extends TestCase
{
    /**
     * @var Subject
     */
    protected $collector;

    protected function setUp(): void
    {
        $this->collector = new Subject();
    }

    public function testSubjectIsExtractedCorrectly()
    {
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertEquals('Improvements in LogEvent entity - added ability to easy list events using logger view helper', $extractedData);
    }
}
