<?php

namespace Simplercode\GAL\Command\Log\Collector\Format;

use Simplercode\GAL\Collector\CollectorInterface;

abstract class AbstractInlineFormatItem implements CollectorInterface
{
    protected string $pattern = '/^%s:(?P<value>[\s\S]*?)$/m';
    protected string $name;

    public function collect(string $rawData): array|string|null
    {
        $matches = array();
        $num = preg_match(sprintf($this->pattern, $this->name), $rawData, $matches);

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
