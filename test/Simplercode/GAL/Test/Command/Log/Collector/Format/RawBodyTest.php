<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit_Framework_TestCase;
use Simplercode\GAL\Command\Log\Collector\Format\RawBody;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class RawBodyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RawBody
     */
    protected $collector;

    protected function setUp()
    {
        $this->collector = new RawBody();
    }

    public function testRawBodyIsExtractedCorrectly()
    {
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertTrue(null !== $extractedData);
        $this->assertContains('added ability to easy list events', $extractedData);
    }
}
