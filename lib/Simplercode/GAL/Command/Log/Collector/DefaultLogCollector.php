<?php

namespace Simplercode\GAL\Command\Log\Collector;

use Simplercode\GAL\Collector\AbstractBatchCollector;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorDate;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorEmail;
use Simplercode\GAL\Command\Log\Collector\Format\AuthorName;
use Simplercode\GAL\Command\Log\Collector\Format\Body;
use Simplercode\GAL\Command\Log\Collector\Format\Subject;

class DefaultLogCollector extends AbstractBatchCollector
{
    protected $name = 'default_log_collector';

    public function __construct(array $childCollectors = null)
    {
        $collectors = (null !== $childCollectors) ? $childCollectors :  $this->getDefaultChildCollectors();
        $this->setCollectors($collectors);
    }

    protected function getDefaultChildCollectors()
    {
        return array(
            new AuthorName(),
            new AuthorEmail(),
            new AuthorDate(),
            new Subject(),
            new Body(),
        );
    }
}
