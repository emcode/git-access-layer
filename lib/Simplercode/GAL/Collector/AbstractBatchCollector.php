<?php

namespace Simplercode\GAL\Collector;

use Simplercode\GAL\Exception\CollectorAlreadyAddedException;
use Simplercode\GAL\Exception\CollectorNotFoundException;

class AbstractBatchCollector implements BatchCollectorInterface
{
    protected string $name;

    /**
     * @var CollectorInterface[]
     */
    protected $collectors = array();

    /**
     * @return array<string,mixed>|string|null
     */
    public function collect(string $rawData): array|string|null
    {
        $result = [];

        foreach ($this->collectors as $name => $collectorInstance)
        {
            $result[$name] = $collectorInstance->collect($rawData);
        }

        return $result;
    }

    /**
     * @param CollectorInterface[] $collectors
     */
    public function setCollectors(array $collectors): self
    {
        $this->collectors = array();

        // add new collectors in way that ensures that
        // keys are collector names and are not added twice
        foreach ($collectors as $c)
        {
            $this->addCollector($c);
        }

        return $this;
    }

    /**
     * @return string[]
     */
    public function getCollectorNames(): array
    {
        return array_keys($this->collectors);
    }

    /**
     * @return CollectorInterface[]
     */
    public function getCollectors(): array
    {
        return $this->collectors;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addCollector(CollectorInterface $collector): self
    {
        $name = $collector->getName();

        if (isset($this->collectors[$name]))
        {
            throw new CollectorAlreadyAddedException($collector);
        }

        $this->collectors[$name] = $collector;

        return $this;
    }

    public function getCollectorByName(string $name): CollectorInterface
    {
        if (!isset($this->collectors[$name]))
        {
            throw new CollectorNotFoundException($name);
        }

        return $this;
    }

    public function removeCollector(string $name): CollectorInterface
    {
        $collector = $this->getCollectorByName($name);
        unset($this->collectors[$name]);

        return $collector;
    }

    public function replaceCollector(CollectorInterface $collector): self
    {
        $name = $collector->getName();
        $this->collectors[$name] = $collector;

        return $this;
    }
}
