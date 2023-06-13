<?php

namespace Simplercode\GAL\Collector;

interface BatchCollectorInterface extends CollectorInterface
{
    /**
     * @return string|null|array<int|string,mixed>
     */
    public function collect(string $rawData): string|array|null;

    /**
     * @param CollectorInterface $collector
     */
    public function addCollector(CollectorInterface $collector): self;

    /**
     * @param CollectorInterface[] $collectors
     */
    public function setCollectors(array $collectors): self;

    /**
     * @return CollectorInterface[]
     */
    public function getCollectors(): array;
}
