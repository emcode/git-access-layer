<?php

namespace Simplercode\GAL\Exception;

use Simplercode\GAL\Collector\CollectorInterface;

class CollectorAlreadyAddedException extends \RuntimeException
{
    public function __construct(CollectorInterface $c)
    {
        parent::__construct(sprintf('Collector with name "%s" was already added (class of received collector: %s)', $c->getName(), get_class($c)));
    }
}
