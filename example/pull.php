<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/helper-functions.php';

use Simplercode\GAL\Command\PullCommand;
use Simplercode\GAL\Processor;

$repoPath = $argv[1];

$processor = new Processor($repoPath);
$initCommand = new PullCommand($processor);
$result = $initCommand->execute(array());
print_r($result);
