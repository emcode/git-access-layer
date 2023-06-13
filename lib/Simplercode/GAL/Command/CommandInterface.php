<?php

namespace Simplercode\GAL\Command;

interface CommandInterface
{
    /**
     * @param array<int,mixed> $arguments
     * @return string|string[]
     */
    public function execute(array $arguments): string|array;
}
