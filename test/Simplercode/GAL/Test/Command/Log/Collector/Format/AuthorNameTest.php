<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorName;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class AuthorNameTest extends TestCase
{
    /**
     * @var AuthorName
     */
    protected $collector;

    protected function setUp(): void
    {
        $this->collector = new AuthorName();
    }

    public function testAuthorNameIsExtractedCorrectly()
    {
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertEquals('John Author', $extractedData);
    }
}
