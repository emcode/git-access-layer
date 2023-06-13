<?php

namespace Simplercode\GAL\Exception;

class CommandNameNotSetException extends \RuntimeException
{
    public function __construct(string $commandClass, string $exceptionSourceMethodName)
    {
        parent::__construct(sprintf('Please set command name using %s::setCommandName method before running: %s', $commandClass, $exceptionSourceMethodName));
    }
}
