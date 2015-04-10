<?php

namespace Simplercode\GAL\Test\Command\Log\Collector\Format;

use PHPUnit_Framework_TestCase;
use Simplercode\GAL\Command\Log\Collector\DefaultLogCollector;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorName;
use Simplercode\GAL\Command\Log\Collector\Format\Subject;
use Simplercode\GAL\Exception\CollectorAlreadyAddedException;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class DefaultLogCollectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DefaultLogCollector
     */
    protected $collector;

    protected function setUp()
    {
        $this->collector = new DefaultLogCollector();
    }

    public function testDefaultLogCollectorHasSomeDefaultChildCollectors()
    {
        $childCollectors = $this->collector->getCollectors();
        $this->assertGreaterThan(0, count($childCollectors));
    }

    public function testDefaultCollectorsAreAddedUsingNameAsKey()
    {
        $childCollectors = $this->collector->getCollectors();
        $realNames = array();

        foreach($childCollectors as $c)
        {
            $realNames[] = $c->getName();
        }

        $this->assertEquals($this->collector->getCollectorNames(), $realNames);
    }

    public function testChildCollectorNamesAreTheKeysInResult()
    {
        $childCollectorNames = $this->collector->getCollectorNames();
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertEquals($childCollectorNames, array_keys($extractedData));
    }

    public function testCanRemoveChildCollectorsBySettingEmptyArray()
    {
        $defaultCollectors = $this->collector->getCollectors();
        $this->assertGreaterThan(0, count($defaultCollectors));
        $defaultCollectorNames = $this->collector->getCollectorNames();
        $this->assertGreaterThan(0, count($defaultCollectorNames));

        $this->collector->setCollectors(array());

        $collectors = $this->collector->getCollectors();
        $this->assertEquals(0, count($collectors));
        $collectorNames = $this->collector->getCollectorNames();
        $this->assertEquals(0, count($collectorNames));
    }

    /**
     * @expectedException \Simplercode\GAL\Exception\CollectorAlreadyAddedException
     */
    public function testCannotAddSameChildCollectorTwice()
    {
        $this->collector->setCollectors(array()); // remove default collectors
        $this->collector->addCollector(new Subject());
        $this->collector->addCollector(new Subject());
    }
}