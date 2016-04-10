<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit_Framework_TestCase;
use Simplercode\GAL\Command\Log\Collector\Format\Subject;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class SubjectTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Subject
     */
    protected $collector;

    protected function setUp()
    {
        $this->collector = new Subject();
    }

    public function testSubjectIsExtractedCorrectly()
    {
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertEquals('Improvements in LogEvent entity - added ability to easy list events using logger view helper', $extractedData);
    }
}
