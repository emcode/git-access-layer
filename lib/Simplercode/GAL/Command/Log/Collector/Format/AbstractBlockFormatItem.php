<?php

namespace Simplercode\GAL\Command\Log\Collector\Format;

use Simplercode\GAL\Collector\CollectorInterface;

abstract class AbstractBlockFormatItem implements CollectorInterface
{
    protected string $pattern = '/^%s:(?P<value>[\s\S]*?):%s/m';
    protected string $name;

    /**
     * @return string|array<mixed>|null
     */
    public function collect(string $rawData): string|array|null
    {
        $matches = [];
        $num = preg_match(sprintf($this->pattern, $this->name, $this->name), $rawData, $matches);

        if (!$num)
        {
            return null;
        }

        return $matches['value'];
    }

    public function getName(): string
    {
        return $this->name;
    }
}
