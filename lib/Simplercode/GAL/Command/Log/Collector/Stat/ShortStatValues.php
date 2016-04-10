<?php

namespace Simplercode\GAL\Command\Log\Collector\Stat;

use Simplercode\GAL\Collector\CollectorInterface;

class ShortStatValues implements CollectorInterface
{
    protected $numberLabelPattern = "(?P<%s>\d+) (?:%s)";
    protected $statsPattern = '/%s((%s)|(%s)|(?:))((%s)|(%s)|(?:))$/m';
    protected $pattern;

    protected $regexLabelToValueType = array(
        'abc_file_num' => 'file.* changed, ',
        'fst_insertion_num' => 'insertion.*\(\+\), ',
        'fst_deletion_num' => 'deletion.*\(\-\)',
        'sec_insertion_num' => 'insertion.*\(\+\)',
        'sec_deletion_num' => 'deletion.*\(\-\)',
    );

    protected function getPattern()
    {
        if (null === $this->pattern)
        {
            $this->pattern = $this->createPattern();
        }

        return $this->pattern;
    }

    protected function createPattern()
    {
        $subPatterns = array();

        foreach ($this->regexLabelToValueType as $label => $type)
        {
            $subPatterns[] = sprintf($this->numberLabelPattern, $label, $type);
        }

        $pattern = vsprintf($this->statsPattern, $subPatterns);

        return $pattern;
    }

    public function collect($rawData)
    {
        $matches = array();
        $num = preg_match($this->getPattern(), $rawData, $matches);

        if (!$num)
        {
            return;
        }

        $collectingResult = $this->processMatchingResult($matches);

        return $collectingResult;
    }

    public function processMatchingResult(array $matches)
    {
        $result = array();

        foreach ($this->regexLabelToValueType as $regexLabel => $valueType)
        {
            if (!isset($matches[$regexLabel]))
            {
                continue;
            }

            $foundValue = ($matches[$regexLabel] !== '') ? ((int) $matches[$regexLabel]) : null;
            $endUserLabel = substr($regexLabel, 4);

            if (!isset($result[$endUserLabel]) || (null === $result[$endUserLabel]))
            {
                $result[$endUserLabel] = $foundValue;
            }
        }

        return $result;
    }

    public function getName()
    {
        return 'shortstat_values';
    }
}
