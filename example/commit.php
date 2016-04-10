<?php
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/helper-functions.php';

use Simplercode\GAL\Command\CommitCommand;
use Simplercode\GAL\Processor;

$repoPath = validateRepoPathAndShowMessage($argv);
$isBare = checkIfBareAndShowMessage($repoPath);

$processor = new Processor($repoPath, $isBare);

$commitCommand = new CommitCommand($processor);
$result = $commitCommand->execute(array(
    '-m',
    sprintf('This is commit message created on %s', date('Y-m-d H:i:s')),
    '--allow-empty'
));

print_r($result);