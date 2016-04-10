<?php

namespace Simplercode\GAL\Collector;

use Simplercode\GAL\Exception\CollectorAlreadyAddedException;
use Simplercode\GAL\Exception\CollectorNotFoundException;

class AbstractBatchCollector implements BatchCollectorInterface
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var CollectorInterface[]
     */
    protected $collectors = array();

    /**
     * @param string $rawData
     *
     * @return string[]|array
     */
    public function collect($rawData)
    {
        $result = array();

        foreach ($this->collectors as $name => $collectorInstance)
        {
            $result[$name] = $collectorInstance->collect($rawData);
        }

        return $result;
    }

    /**
     * @param CollectorInterface[] $collectors
     *
     * @return $this
     */
    public function setCollectors(array $collectors)
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

    public function getCollectorNames()
    {
        return array_keys($this->collectors);
    }

    /**
     * @return CollectorInterface[]
     */
    public function getCollectors()
    {
        return $this->collectors;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addCollector(CollectorInterface $collector)
    {
        $name = $collector->getName();

        if (isset($this->collectors[$name]))
        {
            throw new CollectorAlreadyAddedException($collector);
        }

        $this->collectors[$name] = $collector;

        return $this;
    }

    public function getCollectorByName($name)
    {
        if (!isset($this->collectors[$name]))
        {
            throw new CollectorNotFoundException($name);
        }

        return $this;
    }

    public function removeCollector($name)
    {
        $collector = $this->getCollectorByName($name);
        unset($this->collectors[$name]);

        return $collector;
    }

    public function replaceCollector(CollectorInterface $collector)
    {
        $name = $collector->getName();
        $this->collectors[$name] = $collector;

        return $this;
    }
}
