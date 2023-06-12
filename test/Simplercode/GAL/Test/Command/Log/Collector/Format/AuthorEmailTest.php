<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorEmail;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class AuthorEmailTest extends TestCase
{
    /**
     * @var AuthorEmail
     */
    protected $collector;

    protected function setUp(): void
    {
        $this->collector = new AuthorEmail();
    }

    public function testAuthorEmailIsExtractedCorrectly()
    {
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertEquals('john.author@example.abc', $extractedData);
    }
}
