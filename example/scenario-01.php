<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/helper-functions.php';

use Simplercode\GAL\Command\InitCommand;
use Simplercode\GAL\Command\CommitCommand;
use Simplercode\GAL\Command\LogCommand;
use Simplercode\GAL\Command\Log\Collector\DefaultLogCollector;
use Simplercode\GAL\Processor;
use Simplercode\GAL\Command\Log\Format;

$repoName = $argv[1];
$processor = new Processor(null, false);

$initCommand = new InitCommand($processor);
$initResult = $initCommand->execute(array(
    $repoName,
));

echo $initResult . PHP_EOL;

$processor->setPathToRepo($repoName, false);
$commitCommand = new CommitCommand($processor);

$firstCommitResult = $commitCommand->execute(array(
    '-m',
    sprintf('scenario 01 / commit 01 - this is commit created on %s', date('Y-m-d H:i:s')),
    '--allow-empty',
));

echo $firstCommitResult . PHP_EOL;

$secondCommitResult = $commitCommand->execute(array(
    '-m',
    sprintf('scenario 01 / commit 02 - this is commit created on %s', date('Y-m-d H:i:s')),
    '--allow-empty',
));

echo $secondCommitResult . PHP_EOL;

$logCommand = new LogCommand($processor, new DefaultLogCollector());
$logResult = $logCommand->execute(array(
    '-5',
    '--pretty=tformat:'.Format::CS.Format::GIT_EOL.LogCommand::getDefaultFormat(),
));

foreach($logResult as $i => $logItem)
{
    echo sprintf('Git log item: %s', $i) . PHP_EOL;

    foreach($logItem as $key => $value)
    {
        echo sprintf('  %s: %s', $key, $value) . PHP_EOL;
    }
}
