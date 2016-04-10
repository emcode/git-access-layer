<?php

function validateRepoPathAndShowMessage($scriptArguments, $pathIndex = 1)
{
    $pathToRepo = null;
    $error = null;

    if (empty($scriptArguments[$pathIndex]))
    {
        $error = 'You should pass a repository path as first argument to this script!';

    } else
    {
        $pathToRepo = $scriptArguments[$pathIndex];

        if (!is_dir($pathToRepo))
        {
            $error = sprintf('"%s" is not a directory!', $pathToRepo);
        }
    }

    if (null !== $error)
    {
        echo $error . PHP_EOL;
        echo 'Making early exit...' . PHP_EOL;
        exit;
    }

    echo sprintf('Reading repository from path: %s', $pathToRepo) . PHP_EOL;

    return $pathToRepo;
}

function checkIfBareAndShowMessage($pathToRepo)
{
    $isBare = !is_dir($pathToRepo . '/.git');
    echo sprintf('This repository is %s', $isBare ? 'bare' : 'not bare') . PHP_EOL;

    return $isBare;
}
