<?php

namespace Simplercode\GAL\Command\Base;

use Simplercode\GAL\Collector\CollectorInterface;

interface CollectableCommandInterface
{
    /**
     * @return CollectorInterface
     */
    public function getCollector();

    /**
     * @param CollectorInterface $collector
     * @return $this
     */
    public function setCollector(CollectorInterface $collector);

    /**
     * @param CollectorInterface $collector
     * @return mixed
     */
    public function addCollector(CollectorInterface $collector);
}