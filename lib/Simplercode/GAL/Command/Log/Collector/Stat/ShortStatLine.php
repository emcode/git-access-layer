<?php

namespace Simplercode\GAL\Command\Log\Collector\Stat;

use Simplercode\GAL\Collector\CollectorInterface;

class ShortStatLine implements CollectorInterface
{
    protected string $pattern = "/(?:\d+) file.* changed, ((?:\d+ deletion.*\(\-\))|(?:\d+ insertion.*\(\+\)))((?:[delinstio0-9,\ \(\)\-\+]+)|(?:))/m";

    /**
     * @param string $rawData
     * @return string|array<mixed>|null
     */
    public function collect($rawData): string|array|null
    {
        $matches = [];
        $num = preg_match($this->pattern, $rawData, $matches);

        if (!$num)
        {
            return null;
        }

        return $matches[0];
    }

    public function getName(): string
    {
        return 'shortstat_line';
    }
}
