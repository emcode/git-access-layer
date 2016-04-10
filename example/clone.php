<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/helper-functions.php';

use Simplercode\GAL\Command\CloneCommand;
use Simplercode\GAL\Processor;
use Symfony\Component\Process\ProcessBuilder;

$repoPath = $argv[1];
$targetPath = $argv[2];

$processBuilder = new ProcessBuilder();
$processBuilder->setTimeout(160);

$processor = new Processor();
$processor->setBuilder($processBuilder);
$processor->setRunCallback(function ($type, $buffer) {
    echo 'GIT > ' . $buffer;
});

$cloneCommand = new CloneCommand($processor);
$result = $cloneCommand->execute(array(
    $repoPath,
    $targetPath,
    '--bare',
    '--mirror',
));

print_r($result);
