<?php

namespace Simplercode\GAL\Command\Base;

use Simplercode\GAL\Exception\CommandNameNotSetException;

class DynamicCommand extends AbstractCommand
{
    protected $commandName;

    /**
     * @param array $runtimeArgs
     *
     * @return mixed
     */
    public function execute(array $runtimeArgs)
    {
        if (null === $this->commandName)
        {
            throw new CommandNameNotSetException(self::class, __METHOD__);
        }

        return parent::execute($runtimeArgs);
    }

    /**
     * @return string|null
     */
    public function getCommandName()
    {
        return $this->commandName;
    }

    /**
     * @param string $commandName
     *
     * @return DynamicCommand
     */
    public function setCommandName($commandName)
    {
        $this->commandName = $commandName;

        return $this;
    }
}
