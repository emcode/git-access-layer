<?php
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/helper-functions.php';

use Simplercode\GAL\Command\RemoteCommand;
use Simplercode\GAL\Processor;

$repoName = $argv[1];

$processor = new Processor($repoName);
$remoteCommand = new RemoteCommand($processor);
$result = $remoteCommand->execute(array(
    'update'
));
print_r($result);