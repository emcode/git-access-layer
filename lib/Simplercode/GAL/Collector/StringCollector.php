<?php

namespace Simplercode\GAL\Collector;

class StringCollector implements CollectorInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'string';
    }

    public function collect(string $rawData): string
    {
        return (string) $rawData;
    }
}
