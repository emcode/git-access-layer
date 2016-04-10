<?php

namespace Simplercode\GAL\Collector;

interface CollectorInterface
{
    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param string $rawData
     *
     * @return mixed
     */
    public function collect($rawData);
}
