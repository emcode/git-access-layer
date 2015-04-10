<?php

namespace Simplercode\GitUtils;

use Mooncms\Form\Entity\Form;
use Symfony\Component\Process\ProcessBuilder;

class Utils
{
    public static function execute(array $args)
    {
        $builder = new ProcessBuilder();
        $builder->setPrefix('git');
        $builder->setArguments($args);
        $process = $builder->getProcess();
        $process->mustRun();
        $output = $process->getOutput();
        return $output;
    }

    public static function splitCommits(array $lines)
    {
        $commits = array();
        $currentBuffer = null;

        foreach($lines as $someString)
        {
            $commitLine = strpos($someString, 'commit ') === 0;

            if ($commitLine)
            {
                if (null !== $currentBuffer)
                {
                    $commits[] = $currentBuffer;
                }

                $currentBuffer = array();
            }

            $currentBuffer[] = $someString;
        }

        if (null !== $currentBuffer && count($currentBuffer) > 0)
        {
            $commits[] = $currentBuffer;
        }

        return $commits;
    }

    public static function parseStatsOutput($output)
    {
        $commits = explode(Format::CS, $output);

        echo $commits[2]; die;

        $commitItems = self::splitCommits($lines);
        $parsedCommitData = array();

        foreach($commitItems as $commitLines)
        {
            $parsedCommitData[] = self::parseStatsItem($commitLines);
        }

        return $parsedCommitData;
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
     * @param $path
     * @return array
     */
    public static function stats($path)
    {
        chdir($path);

        $args = array();
        $args[] = 'log';
        $args[] = '-n 1';
        $args[] = '--skip=6';
        // $args[] = '--stat';
        $args[] = '--shortstat';
        $args[] = '--date=iso';
        $args[] = '--pretty=tformat:' . Format::CS . Format::GIT_EOL . self::getDefaultFormat();
        // return self::execute($args);
        return self::parseStatsOutput(self::execute($args));
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