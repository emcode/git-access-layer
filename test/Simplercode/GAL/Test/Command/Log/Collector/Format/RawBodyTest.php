<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\Format\RawBody;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class RawBodyTest extends TestCase
{
    /**
     * @var RawBody
     */
    protected $collector;

    protected function setUp(): void
    {
        $this->collector = new RawBody();
    }

    public function testRawBodyIsExtractedCorrectly()
    {
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertTrue(null !== $extractedData);
        $this->assertStringContainsString('added ability to easy list events', $extractedData);
    }
}
