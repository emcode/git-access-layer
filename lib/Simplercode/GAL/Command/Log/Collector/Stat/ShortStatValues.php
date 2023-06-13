<?php

namespace Simplercode\GAL\Command\Log\Collector\Stat;

use Simplercode\GAL\Collector\CollectorInterface;

class ShortStatValues implements CollectorInterface
{
    protected string $numberLabelPattern = "(?P<%s>\d+) (?:%s)";
    protected string $statsPattern = '/%s((%s)|(%s)|(?:))((%s)|(%s)|(?:))$/m';
    protected ?string $pattern = null;

    /**
     * @var array<string,string>
     */
    protected array $regexLabelToValueType = [
        'abc_file_num' => 'file.* changed, ',
        'fst_insertion_num' => 'insertion.*\(\+\), ',
        'fst_deletion_num' => 'deletion.*\(\-\)',
        'sec_insertion_num' => 'insertion.*\(\+\)',
        'sec_deletion_num' => 'deletion.*\(\-\)',
    ];

    protected function getPattern(): string
    {
        if (null === $this->pattern)
        {
            $this->pattern = $this->createPattern();
        }

        return $this->pattern;
    }

    protected function createPattern(): string
    {
        $subPatterns = [];

        foreach ($this->regexLabelToValueType as $label => $type)
        {
            $subPatterns[] = sprintf($this->numberLabelPattern, $label, $type);
        }

        $pattern = vsprintf($this->statsPattern, $subPatterns);

        return $pattern;
    }

    /**
     * @return array<string,int|null>|string
     */
    public function collect(string $rawData): array|string
    {
        $matches = array();
        $num = preg_match($this->getPattern(), $rawData, $matches);

        if (!$num)
        {
            return [];
        }

        $collectingResult = $this->processMatchingResult($matches);

        return $collectingResult;
    }

    /**
     * @param array<string,string> $matches
     * @return array<string,int|null>
     */
    public function processMatchingResult(array $matches): array
    {
        $result = [];

        foreach ($this->regexLabelToValueType as $regexLabel => $valueType)
        {
            if (!isset($matches[$regexLabel]))
            {
                continue;
            }

            $foundValue = ($matches[$regexLabel] !== '') ? ((int) $matches[$regexLabel]) : null;
            $endUserLabel = substr($regexLabel, 4);

            if (!isset($result[$endUserLabel]))
            {
                $result[$endUserLabel] = $foundValue;
            }
        }

        return $result;
    }

    public function getName(): string
    {
        return 'shortstat_values';
    }
}
