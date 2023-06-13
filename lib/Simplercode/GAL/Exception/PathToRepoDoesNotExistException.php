<?php

namespace Simplercode\GAL\Exception;

class PathToRepoDoesNotExistException extends \RuntimeException
{
    public function __construct(string $path)
    {
        parent::__construct(sprintf('Received path "%s" is not a directory', $path));
    }
}
