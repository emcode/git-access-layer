<?php

namespace Simplercode\GAL\Command;

interface CommandInterface
{
    /**
     * @param array $arguments
     *
     * @return array|string
     */
    public function execute(array $arguments);
}
