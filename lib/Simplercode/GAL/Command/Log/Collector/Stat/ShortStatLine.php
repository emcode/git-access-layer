<?php

namespace Simplercode\GAL\Command\Log\Collector\Stat;

use Simplercode\GAL\Collector\CollectorInterface;

class ShortStatLine implements CollectorInterface
{
    protected $pattern = "/(?:\d+) file.* changed, ((?:\d+ deletion.*\(\-\))|(?:\d+ insertion.*\(\+\)))((?:[delinstio0-9,\ \(\)\-\+]+)|(?:))/m";

    public function collect($rawData)
    {
        $matches = array();
        $num = preg_match($this->pattern, $rawData, $matches);

        if (!$num)
        {
            return;
        }

        return $matches[0];
    }

    public function getName()
    {
        return 'shortstat_line';
    }
}
