<?php

namespace Simplercode\GAL\Command;

use Simplercode\GAL\Collector\BatchCollectorInterface;
use Simplercode\GAL\Command\Base\AbstractCommand;
use Simplercode\GAL\Command\Log\Format;

class LogCommand extends AbstractCommand
{
    public function getCommandName()
    {
        return 'log';
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