<?php

namespace Simplercode\GAL;

use Symfony\Component\Process\Process;

class Processor
{
    /**
     * @var string
     */
    protected $pathToGitBin;

    /**
     * @var array<int,mixed>|null
     */
    protected $repoArgs;

    /**
     * @var array<int,mixed>|null
     */
    protected $initArgs;

    /**
     * Function that will be run many times during command execution.
     * This gives you ability to incrementally show output to the user during long running tasks.
     * 
     * @var callable|null
     */
    protected $runCallback = null;

    /**
     * @param ?string $pathToRepo   Path to working tree (for non bare repos) or repo dir (for bare repos)
     * @param bool   $isRepoBare
     * @param string $pathToGitBin
     */
    public function __construct(?string $pathToRepo = null, bool $isRepoBare = true, string $pathToGitBin = 'git')
    {
        $this->pathToGitBin = $pathToGitBin;

        if (null !== $pathToRepo)
        {
            $this->repoArgs = $this->createRepoArgs($pathToRepo, $isRepoBare);
        }
    }

    /**
     * @param array<int,mixed> $repoArgs
     */
    public function setRepoArgs(array $repoArgs): void
    {
        $this->repoArgs = $repoArgs;
        $this->initArgs = null;
    }

    /**
     * @param array<int,mixed>|null $otherArgs
     * @return array<int,mixed>
     */
    public function createInitArgs(string $gitBin, array $otherArgs = null): array
    {
        $initArgs = [];
        $initArgs[] = $gitBin;

        if (null !== $otherArgs) {
            $initArgs = array_merge($initArgs, $otherArgs);
        }

        return $initArgs;
    }

    /**
     * @return array<int, mixed>
     */
    public function createRepoArgs(string $pathToRepo, bool $isBare): array
    {
        $args = array();

        if ($isBare) {
            $args[] = '--git-dir='.$pathToRepo;
        } else {
            $args[] = '--git-dir='.$pathToRepo.'/.git';
            $args[] = '--work-tree='.$pathToRepo;
        }

        return $args;
    }

    /**
     * @param array<int,mixed> $runtimeArgs
     * @return string
     */
    public function execute(array $runtimeArgs): string
    {
        if (null === $this->initArgs)
        {
            $this->initArgs = $this->createInitArgs($this->pathToGitBin, $this->repoArgs);
        }

        $process = new Process(
            array_merge($this->initArgs, $runtimeArgs)
        );
        $process->mustRun($this->runCallback);
        $output = $process->getOutput();

        return $output;
    }

    public function setPathToRepo(string $pathToRepo, bool $isRepoBare = true): void
    {
        $this->repoArgs = $this->createRepoArgs($pathToRepo, $isRepoBare);
        $this->initArgs = null;
    }

    public function setPathToGitBin(string $pathToGitBin): void
    {
        $this->pathToGitBin = $pathToGitBin;
        $this->initArgs = null;
    }

    public function areInitArgsSet(): bool
    {
        return null !== $this->initArgs;
    }

    /**
     * @return string
     */
    public function getPathToGitBin(): string
    {
        return $this->pathToGitBin;
    }

    /**
     * @return array<int,mixed>|null
     */
    public function getRepoArgs(): ?array
    {
        return $this->repoArgs;
    }

    /**
     * @return array<int,mixed>|null
     */
    public function getInitArgs(): ?array
    {
        return $this->initArgs;
    }

    /**
     * @param array<int,mixed>|null $initArgs
     */
    public function setInitArgs(?array $initArgs): void
    {
        $this->initArgs = $initArgs;
    }

    /**
     * @return callable|null
     */
    public function getRunCallback(): ?callable
    {
        return $this->runCallback;
    }

    /**
     * @param callable|null $runCallback
     * 
     * @return Processor
     */
    public function setRunCallback(?callable $runCallback)
    {
        $this->runCallback = $runCallback;

        return $this;
    }
}
