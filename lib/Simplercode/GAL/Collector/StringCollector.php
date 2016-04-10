<?php

namespace Simplercode\GAL\Collector;

class StringCollector implements CollectorInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'string';
    }

    /**
     * @param string $rawData
     *
     * @return string
     */
    public function collect($rawData)
    {
        return (string) $rawData;
    }
}
