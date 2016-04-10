<?php

namespace Simplercode\GAL;

use Symfony\Component\Process\ProcessBuilder;

class Processor
{
    /**
     * @var string
     */
    protected $pathToGitBin;

    /**
     * @var array|null
     */
    protected $repoArgs;

    /**
     * @var array|null
     */
    protected $initArgs;

    /**
     * @var ProcessBuilder
     */
    protected $builder;

    /**
     * Function that will be run many times during command execution.
     * This gives you ability to incrementally show output to the user during long running tasks.
     * 
     * @var callable|null
     */
    protected $runCallback;

    /**
     * @param null   $pathToRepo   Path to working tree (for non bare repos) or repo dir (for bare repos)
     * @param bool   $isRepoBare
     * @param string $pathToGitBin
     */
    public function __construct($pathToRepo = null, $isRepoBare = true, $pathToGitBin = 'git')
    {
        $this->pathToGitBin = $pathToGitBin;

        if (null !== $pathToRepo)
        {
            $this->repoArgs = $this->createRepoArgs($pathToRepo, $isRepoBare);
        }
    }

    /**
     * @param array $repoArgs
     */
    public function setRepoArgs(array $repoArgs)
    {
        $this->repoArgs = $repoArgs;
        $this->initArgs = null;
    }

    public function createInitArgs($gitBin, array $otherArgs = null)
    {
        $initArgs = array();
        $initArgs[] = $gitBin;

        if (null !== $otherArgs) {
            $initArgs = array_merge($initArgs, $otherArgs);
        }

        return $initArgs;
    }

    public function createRepoArgs($pathToRepo, $isBare)
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

    public function execute(array $runtimeArgs)
    {
        if (null === $this->builder)
        {
            $this->builder = new ProcessBuilder();
        }

        if (null === $this->initArgs)
        {
            $this->initArgs = $this->createInitArgs($this->pathToGitBin, $this->repoArgs);
            $this->builder->setPrefix($this->initArgs);
        }

        $this->builder->setArguments($runtimeArgs);
        $process = $this->builder->getProcess();
        $process->mustRun($this->runCallback);
        $output = $process->getOutput();

        return $output;
    }

    public function setPathToRepo($pathToRepo, $isRepoBare = true)
    {
        $this->repoArgs = $this->createRepoArgs($pathToRepo, $isRepoBare);
        $this->initArgs = null;
    }

    /**
     * @param mixed $pathToGitBin
     */
    public function setPathToGitBin($pathToGitBin)
    {
        $this->pathToGitBin = $pathToGitBin;
        $this->initArgs = null;
    }

    public function areInitArgsSet()
    {
        return null !== $this->initArgs;
    }

    /**
     * @return string
     */
    public function getPathToGitBin()
    {
        return $this->pathToGitBin;
    }

    /**
     * @return array|null
     */
    public function getRepoArgs()
    {
        return $this->repoArgs;
    }

    /**
     * @return array|null
     */
    public function getInitArgs()
    {
        return $this->initArgs;
    }

    /**
     * @param array|null $initArgs
     */
    public function setInitArgs(array $initArgs)
    {
        $this->initArgs = $initArgs;
    }

    /**
     * @return ProcessBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * @param ProcessBuilder $builder
     *
     * @return Processor
     */
    public function setBuilder(ProcessBuilder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * @return callable|null
     */
    public function getRunCallback()
    {
        return $this->runCallback;
    }

    /**
     * @param callable|null $runCallback
     * 
     * @return Processor
     */
    public function setRunCallback($runCallback)
    {
        $this->runCallback = $runCallback;

        return $this;
    }
}
