<?php

namespace Simplercode\GAL\Collector;

interface BatchCollectorInterface extends CollectorInterface
{
    /**
     * @param string $rawData
     *
     * @return string[]|array
     */
    public function collect($rawData);

    /**
     * @param CollectorInterface $collector
     *
     * @return $this
     */
    public function addCollector(CollectorInterface $collector);

    /**
     * @param CollectorInterface[] $collectors
     *
     * @return $this
     */
    public function setCollectors(array $collectors);

    /**
     * @return CollectorInterface[]
     */
    public function getCollectors();
}
