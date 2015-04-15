<?php
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/helper-functions.php';

use Simplercode\GAL\Command\Log\LogCommand;
use Simplercode\GAL\Command\Log\Format;
use Simplercode\GAL\Command\Log\Collector\DefaultLogCollector;
use Simplercode\GAL\Processor;

$repoPath = validateRepoPathAndShowMessage($argv);
$isBare = checkIfBareAndShowMessage($repoPath);

$processor = new Processor($repoPath, $isBare);
$collector = new DefaultLogCollector();
$logCommand = new LogCommand($processor, $collector);
$result = $logCommand->execute(array(
    '-5',
    '--pretty=tformat:' . Format::CS . Format::GIT_EOL . LogCommand::getDefaultFormat()
));

print_r($result);