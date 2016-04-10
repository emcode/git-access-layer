<?php

namespace Simplercode\GAL\Test\Command;

use PHPUnit_Framework_TestCase;
use Simplercode\GAL\Command\Log\Collector\DefaultLogCollector;
use Simplercode\GAL\Command\LogCommand;
use Simplercode\GAL\Processor;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class LogCommandTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var LogCommand
     */
    protected $logCommand;

    protected function setUp()
    {
        $processor = new Processor();
        $collector = new DefaultLogCollector();
        $this->logCommand = new LogCommand($processor, $collector);
    }

    public function testSplittingOfThree()
    {
        $rawCommits = $this->logCommand->splitOutputToCommits(LogCommandFixture::SPLITTING_FIXTURE_THREE);
        $this->assertInternalType('array', $rawCommits);
        $this->assertCount(3, $rawCommits);
        $this->assertContains("xyz qwerty", $rawCommits[2]);
    }

    public function testSplittingOfNone()
    {
        $rawCommits = $this->logCommand->splitOutputToCommits(LogCommandFixture::SPLITTING_FIXTURE_EMPTY);
        $this->assertInternalType('array', $rawCommits);
        $this->assertCount(0, $rawCommits);
    }

    public function testSplittingOfOne()
    {
        $rawCommits = $this->logCommand->splitOutputToCommits(LogCommandFixture::SPLITTING_FIXTURE_ONE);
        $this->assertInternalType('array', $rawCommits);
        $this->assertCount(1, $rawCommits);
        $this->assertContains("abcd efgh", $rawCommits[0]);
    }
}