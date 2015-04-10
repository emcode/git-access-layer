<?php

namespace Simplercode\GAL\Collector;

interface CollectorInterface
{
    public function getName();

    /**
     * @param string $rawData
     * @return string|null
     */
    public function collect($rawData);
}