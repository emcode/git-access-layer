<?php

namespace Simplercode\GAL\Command;

use Simplercode\GAL\Collector\BatchCollectorInterface;
use Simplercode\GAL\Command\Base\AbstractCommand;
use Simplercode\GAL\Command\Log\Format;

class LogCommand extends AbstractCommand
{
    public function getCommandName(): string
    {
        return 'log';
    }

    /**
     * @return array<int<0, max>, array<int|string, mixed>|string|null>
     */
    public function parseOutput(string $output): array
    {
        $rawCommits = $this->splitOutputToCommits($output);
        $commits = $this->parseRawCommits($rawCommits);

        return $commits;
    }

    /**
     * @return string[]
     */
    public function splitOutputToCommits(string $output): array
    {
        $commits = explode(Format::CS, $output);
        array_shift($commits);

        return $commits;
    }

    /**
     * @param string[] $rawCommits
     * @return array<int<0, max>, array<int|string, mixed>|string|null>
     */
    public function parseRawCommits(array $rawCommits): array
    {
        $result = [];

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
                $result[] = [ $name => $this->collector->collect($rawCommitString) ];
            }
        }

        return $result;
    }

    public static function getDefaultFormat(): string
    {
        $parts = [];

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
