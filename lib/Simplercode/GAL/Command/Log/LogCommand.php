<?php

namespace Simplercode\GAL\Command\Log;

use Simplercode\GAL\Collector\BatchCollectorInterface;
use Simplercode\GAL\Collector\CollectorInterface;
use Simplercode\GAL\Command\CommandInterface;
use Simplercode\GAL\Processor;

class LogCommand implements CommandInterface
{
    const CMD = "log";

    /**
     * @var CollectorInterface
     */
    protected $collector;

    /**
     * @var Processor
     */
    protected $processor;

    function __construct(Processor $processor, CollectorInterface $collector)
    {
        $this->processor = $processor;
        $this->collector = $collector;
    }

    public function execute(array $runtimeArgs)
    {
        array_unshift($runtimeArgs, self::CMD);
        $output = $this->processor->execute($runtimeArgs);
        $result = $this->parseOutput($output);
        return $result;
    }

    public function parseOutput($output)
    {
        $rawCommits = $this->splitOutputToCommits($output);
        $commits = $this->parseRawCommits($rawCommits);
        return $commits;
    }

    public function splitOutputToCommits($output)
    {
        $commits = explode(Format::CS, $output);
        array_shift($commits);
        return $commits;
    }

    public function parseRawCommits(array $rawCommits)
    {
        $result = array();

        if ($this->collector instanceof BatchCollectorInterface)
        {
            foreach($rawCommits as $rawCommitString)
            {
                $result[] = $this->collector->collect($rawCommitString);
            }

        } else
        {
            $name = $this->collector->getName();

            foreach($rawCommits as $rawCommitString)
            {
                $result[] = array($name => $this->collector->collect($rawCommitString));
            }
        }

        return $result;
    }

    public static function getDefaultFormat()
    {
        $parts = array();

        foreach(Format::$inlineFormats as $label => $format)
        {
            $parts[] = $label . ':' . $format;
        }

        foreach(Format::$blockFormats as $label => $format)
        {
            $parts[] = $label . ':' . Format::GIT_EOL . $format . Format::GIT_EOL . ':' . $label;
        }

        $format = implode(Format::GIT_EOL, $parts);
        return $format;
    }

    /**
     * @return CollectorInterface
     */
    public function getCollector()
    {
        return $this->collector;
    }

    /**
     * @param CollectorInterface $collector
     * @return $this
     */
    public function setCollector(CollectorInterface $collector)
    {
        $this->collector = $collector;
        return $this;
    }

    public function addCollector(CollectorInterface $collector)
    {
        if (!($this->collector instanceof BatchCollectorInterface))
        {
            throw new \RuntimeException(sprintf(
                'Current base collector of class %s does not implement %s interface, therefore you cannot add child collector using %s method',
                get_class($this->collector), 'BatchCollectorInterface', __METHOD__
            ));
        }

        $this->collector->addCollector($collector);
        return $this;
    }

    private static function extractAuthorName($line)
    {
        $matches = array();
        $num = preg_match('/: (?P<name>[^<]+) </', $line, $matches);

        if (!$num)
        {
            throw new \RuntimeException(sprintf(
                'Could not extract commit author name from string: "%s"', $line
            ));
        }

        return $matches['name'];
    }

    private static function extractAuthorEmail($line)
    {
        $matches = array();
        $num = preg_match('/<(?P<email>[^<]+)>/', $line, $matches);

        if (!$num)
        {
            throw new \RuntimeException(sprintf(
                'Could not extract commit author name from string: "%s"', $line
            ));
        }

        return $matches['email'];
    }

    private static function extractCommitDate($dateString)
    {
        $normalizedString = trim(substr($dateString, strlen('Date:')));
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s O', $normalizedString);

        if (!$dateTime)
        {
            throw new \RuntimeException(sprintf(
                'Could not extract commit date from string: "%s"', $normalizedString
            ));
        }

        return $dateTime;
    }
}