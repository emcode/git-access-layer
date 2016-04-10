<?php

namespace Simplercode\GAL\Command\Base;

interface CommandInterface
{
    /**
     * @param array $arguments
     * @return array|string
     */
    public function execute(array $arguments);

    /**
     * @return string
     */
    public function getCommandName();
}