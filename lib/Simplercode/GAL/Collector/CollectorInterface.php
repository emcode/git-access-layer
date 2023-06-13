<?php

namespace Simplercode\GAL\Collector;

interface CollectorInterface
{
    public function getName(): string;

    /**
     * @return array<int|string,string|int|null>|string|null
     */
    public function collect(string $rawData): array|string|null;
}
