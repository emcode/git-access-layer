<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit_Framework_TestCase;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorEmail;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorName;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class AuthorEmailTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AuthorEmail
     */
    protected $collector;

    protected function setUp()
    {
        $this->collector = new AuthorEmail();
    }

    public function testAuthorEmailIsExtractedCorrectly()
    {
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertEquals('john.author@example.abc', $extractedData);
    }
}