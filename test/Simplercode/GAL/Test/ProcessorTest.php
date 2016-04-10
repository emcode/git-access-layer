<?php

namespace Simplercode\GAL;

use PHPUnit_Framework_TestCase;

class ProcessorTest extends PHPUnit_Framework_TestCase
{
    public function testDefaultPathToBinIsGit()
    {
        $processor = new Processor();
        $this->assertEquals($processor->getPathToGitBin(), 'git');
    }

    public function testCustomPathToBinCanBeSetViaConstructor()
    {
        $binPath = '/custom/path/git';
        $processor = new Processor(null, true, $binPath);
        $this->assertEquals($processor->getPathToGitBin(), $binPath);
    }

    public function testBareRepoArgsCanBeSetViaConstructor()
    {
        $isBare = true;
        $repoPath = '/custom/path/to/bare/repo';
        $processor = new Processor($repoPath, $isBare);
        $this->assertContains(sprintf('--git-dir=%s', $repoPath), $processor->getRepoArgs());
    }

    public function testNonBareRepoArgsCanBeSetViaConstructor()
    {
        $isBare = false;
        $repoPath = '/custom/path/to/repo';
        $processor = new Processor($repoPath, $isBare);
        $this->assertContains(sprintf('--git-dir=%s/.git', $repoPath), $processor->getRepoArgs());
        $this->assertContains(sprintf('--work-tree=%s', $repoPath), $processor->getRepoArgs());
    }

    public function testCreateRepoArgsMethodForNonBareRepo()
    {
        $isBare = false;
        $repoPath = '/custom/path/to/repo';
        $processor = new Processor();
        $nonBareArgs = $processor->createRepoArgs($repoPath, $isBare);
        $this->assertContains(sprintf('--git-dir=%s/.git', $repoPath), $nonBareArgs);
        $this->assertContains(sprintf('--work-tree=%s', $repoPath), $nonBareArgs);
        $this->assertCount(2, $nonBareArgs);
    }

    public function testCreateRepoArgsMethodForBareRepo()
    {
        $isBare = true;
        $repoPath = '/custom/path/to/another/repo';
        $processor = new Processor();
        $bareArgs = $processor->createRepoArgs($repoPath, $isBare);
        $this->assertContains(sprintf('--git-dir=%s', $repoPath), $bareArgs);
        $this->assertCount(1, $bareArgs);
    }

    public function testInitArgsAreNullifiedAfterSettingGitBinPath()
    {
        $processor = new Processor();
        $processor->setInitArgs(array());
        $processor->setPathToGitBin('/some/path/to/git');
        $this->assertFalse($processor->areInitArgsSet());
    }

    public function testInitArgsAreNullifiedAfterSettingRepoArgs()
    {
        $processor = new Processor();
        $processor->setInitArgs(array());
        $processor->setRepoArgs(array());
        $this->assertFalse($processor->areInitArgsSet());
    }

    public function testInitArgsAreNullifiedAfterSettingRepoPath()
    {
        $processor = new Processor();
        $processor->setInitArgs(array());
        $processor->setPathToRepo('/some/path/to/repo');
        $this->assertFalse($processor->areInitArgsSet());
    }
}
