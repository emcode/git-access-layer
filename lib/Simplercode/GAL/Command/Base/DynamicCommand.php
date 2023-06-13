<?php

namespace Simplercode\GAL\Command\Base;

use Simplercode\GAL\Exception\CommandNameNotSetException;

class DynamicCommand extends AbstractCommand
{
    /**
     * This field should be set / overridden in more specific child class.
     *
     * @var string
     */
    protected $commandName;

    public function execute(array $runtimeArgs): array|string|null
    {
        if (null === $this->commandName)
        {
            throw new CommandNameNotSetException(self::class, __METHOD__);
        }

        return parent::execute($runtimeArgs);
    }

    public function getCommandName(): string
    {
        return $this->commandName;
    }

    public function setCommandName(string $commandName): self
    {
        $this->commandName = $commandName;

        return $this;
    }
}
