<?php

namespace Simplercode\GAL\Command\Base;

interface CommandInterface
{
    /**
     * @param array<int,mixed> $arguments
     * @return array<int|string,mixed>|string|null
     */
    public function execute(array $arguments): array|string|null;

    public function getCommandName(): string;
}
