<?php
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/helper-functions.php';

use Simplercode\GAL\Command\InitCommand;
use Simplercode\GAL\Processor;

$repoName = $argv[1];

$processor = new Processor();
$initCommand = new InitCommand($processor);
$result = $initCommand->execute(array(
    $repoName,
    '--bare'
));

print_r($result);