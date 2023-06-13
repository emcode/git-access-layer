<?php

namespace Simplercode\GAL\Test\Command;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\DefaultLogCollector;
use Simplercode\GAL\Command\LogCommand;
use Simplercode\GAL\Processor;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class LogCommandTest extends TestCase
{
    /**
     * @var LogCommand
     */
    protected $logCommand;

    protected function setUp(): void
    {
        $processor = new Processor();
        $collector = new DefaultLogCollector();
        $this->logCommand = new LogCommand($processor, $collector);
    }

    public function testSplittingOfThree(): void
    {
        $rawCommits = $this->logCommand->splitOutputToCommits(LogCommandFixture::SPLITTING_FIXTURE_THREE);
        $this->assertIsArray($rawCommits);
        $this->assertCount(3, $rawCommits);
        $this->assertStringContainsString('xyz qwerty', $rawCommits[2]);
    }

    public function testSplittingOfNone(): void
    {
        $rawCommits = $this->logCommand->splitOutputToCommits(LogCommandFixture::SPLITTING_FIXTURE_EMPTY);
        $this->assertIsArray($rawCommits);
        $this->assertCount(0, $rawCommits);
    }

    public function testSplittingOfOne(): void
    {
        $rawCommits = $this->logCommand->splitOutputToCommits(LogCommandFixture::SPLITTING_FIXTURE_ONE);
        $this->assertIsArray($rawCommits);
        $this->assertCount(1, $rawCommits);
        $this->assertStringContainsString('abcd efgh', $rawCommits[0]);
    }
}
