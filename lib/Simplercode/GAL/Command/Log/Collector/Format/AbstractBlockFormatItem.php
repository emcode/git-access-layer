<?php

namespace Simplercode\GAL\Command\Log\Collector\Format;

use Simplercode\GAL\Collector\CollectorInterface;

abstract class AbstractBlockFormatItem implements CollectorInterface
{
    protected $pattern = '/^%s:(?P<value>[\s\S]*?):%s/m';
    protected $name;

    public function collect($rawData)
    {
        $matches = array();
        $num = preg_match(sprintf($this->pattern, $this->name, $this->name), $rawData, $matches);

        if (!$num)
        {
            return null;
        }

        return $matches['value'];
    }

    public function getName()
    {
        return $this->name;
    }
}