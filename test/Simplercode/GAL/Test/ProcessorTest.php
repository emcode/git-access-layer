<?php

namespace Simplercode\GAL;

use PHPUnit\Framework\TestCase;

class ProcessorTest extends TestCase
{
    public function testDefaultPathToBinIsGit(): void
    {
        $processor = new Processor();
        $this->assertEquals($processor->getPathToGitBin(), 'git');
    }

    public function testCustomPathToBinCanBeSetViaConstructor(): void
    {
        $binPath = '/custom/path/git';
        $processor = new Processor(null, true, $binPath);
        $this->assertEquals($processor->getPathToGitBin(), $binPath);
    }

    public function testBareRepoArgsCanBeSetViaConstructor(): void
    {
        $isBare = true;
        $repoPath = '/custom/path/to/bare/repo';
        $processor = new Processor($repoPath, $isBare);
        $args = $processor->getRepoArgs();
        $this->assertIsArray($args);
        $this->assertContains(sprintf('--git-dir=%s', $repoPath), $args);
    }

    public function testNonBareRepoArgsCanBeSetViaConstructor(): void
    {
        $isBare = false;
        $repoPath = '/custom/path/to/repo';
        $processor = new Processor($repoPath, $isBare);
        $args = $processor->getRepoArgs();
        $this->assertIsArray($args);
        $this->assertContains(sprintf('--git-dir=%s/.git', $repoPath), $args);
        $this->assertContains(sprintf('--work-tree=%s', $repoPath), $args);
    }

    public function testCreateRepoArgsMethodForNonBareRepo(): void
    {
        $isBare = false;
        $repoPath = '/custom/path/to/repo';
        $processor = new Processor();
        $nonBareArgs = $processor->createRepoArgs($repoPath, $isBare);
        $this->assertContains(sprintf('--git-dir=%s/.git', $repoPath), $nonBareArgs);
        $this->assertContains(sprintf('--work-tree=%s', $repoPath), $nonBareArgs);
        $this->assertCount(2, $nonBareArgs);
    }

    public function testCreateRepoArgsMethodForBareRepo(): void
    {
        $isBare = true;
        $repoPath = '/custom/path/to/another/repo';
        $processor = new Processor();
        $bareArgs = $processor->createRepoArgs($repoPath, $isBare);
        $this->assertContains(sprintf('--git-dir=%s', $repoPath), $bareArgs);
        $this->assertCount(1, $bareArgs);
    }

    public function testInitArgsAreNullifiedAfterSettingGitBinPath(): void
    {
        $processor = new Processor();
        $processor->setInitArgs(array());
        $processor->setPathToGitBin('/some/path/to/git');
        $this->assertFalse($processor->areInitArgsSet());
    }

    public function testInitArgsAreNullifiedAfterSettingRepoArgs(): void
    {
        $processor = new Processor();
        $processor->setInitArgs(array());
        $processor->setRepoArgs(array());
        $this->assertFalse($processor->areInitArgsSet());
    }

    public function testInitArgsAreNullifiedAfterSettingRepoPath(): void
    {
        $processor = new Processor();
        $processor->setInitArgs(array());
        $processor->setPathToRepo('/some/path/to/repo');
        $this->assertFalse($processor->areInitArgsSet());
    }
}
