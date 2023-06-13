<?php

namespace Simplercode\GAL\Test\Command\Log\Collector;

use PHPUnit\Framework\TestCase;
use Simplercode\GAL\Command\Log\Collector\DefaultLogCollector;
use Simplercode\GAL\Command\Log\Collector\Format\Subject;
use Simplercode\GAL\Test\Command\Log\LogCommandFixture;

class DefaultLogCollectorTest extends TestCase
{
    /**
     * @var DefaultLogCollector
     */
    protected $collector;

    protected function setUp(): void
    {
        $this->collector = new DefaultLogCollector();
    }

    public function testDefaultLogCollectorHasSomeDefaultChildCollectors(): void
    {
        $childCollectors = $this->collector->getCollectors();
        $this->assertGreaterThan(0, count($childCollectors));
    }

    public function testDefaultCollectorsAreAddedUsingNameAsKey(): void
    {
        $childCollectors = $this->collector->getCollectors();
        $realNames = array();

        foreach($childCollectors as $c)
        {
            $realNames[] = $c->getName();
        }

        $this->assertEquals($this->collector->getCollectorNames(), $realNames);
    }

    public function testChildCollectorNamesAreTheKeysInResult(): void
    {
        $childCollectorNames = $this->collector->getCollectorNames();
        $extractedData = $this->collector->collect(LogCommandFixture::PARSING_FIXTURE_RAW_COMMIT);
        $this->assertIsArray($extractedData);
        $this->assertEquals($childCollectorNames, array_keys($extractedData));
    }

    public function testCanRemoveChildCollectorsBySettingEmptyArray(): void
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

    public function testCannotAddSameChildCollectorTwice(): void
    {
        $this->expectException(\Simplercode\GAL\Exception\CollectorAlreadyAddedException::class);
        $this->collector->setCollectors([]); // remove default collectors
        $this->collector->addCollector(new Subject());
        $this->collector->addCollector(new Subject());
    }
}
