<?php

namespace Simplercode\GAL\Exception;

class CollectorNotFoundException extends \RuntimeException
{
    public function __construct($name)
    {
        parent::__construct(sprintf('Collector with name "%s" could not be found!', $name));
    }
}