<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit_Framework_TestCase;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorName;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class AuthorNameTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AuthorName
     */
    protected $collector;

    protected function setUp()
    {
        $this->collector = new AuthorName();
    }

    public function testAuthorNameIsExtractedCorrectly()
    {
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertEquals('John Author', $extractedData);
    }
}