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
            $parts[] = $label.':'.$format;
        }

        foreach(Format::$blockFormats as $label => $format)
        {
            $parts[] = $label.':'.Format::GIT_EOL.$format.Format::GIT_EOL.':'.$label;
        }

        $format = implode(Format::GIT_EOL, $parts);

        return $format;
    }
}
