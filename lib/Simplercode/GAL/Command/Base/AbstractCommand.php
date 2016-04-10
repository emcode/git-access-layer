<?php

namespace Simplercode\GAL\Command\Base;

use Simplercode\GAL\Collector\BatchCollectorInterface;
use Simplercode\GAL\Collector\CollectorInterface;
use Simplercode\GAL\Collector\StringCollector;
use Simplercode\GAL\Processor;

abstract class AbstractCommand implements CommandInterface, CollectableCommandInterface
{
    /**
     * @var CollectorInterface
     */
    protected $collector;

    /**
     * @var Processor
     */
    protected $processor;

    /**
     * AbstractCommand constructor.
     *
     * @param Processor               $processor
     * @param CollectorInterface|null $collector
     */
    public function __construct(Processor $processor, CollectorInterface $collector = null)
    {
        $this->processor = $processor;
        $this->collector = (null === $collector) ? new StringCollector() : $collector;
    }

    /**
     * @return string
     */
    abstract public function getCommandName();

    /**
     * @param array $runtimeArgs
     *
     * @return mixed
     */
    public function execute(array $runtimeArgs)
    {
        array_unshift($runtimeArgs, $this->getCommandName());
        $output = $this->processor->execute($runtimeArgs);
        $result = $this->parseOutput($output);

        return $result;
    }

    /**
     * @param $rawData
     *
     * @return mixed
     */
    public function parseOutput($rawData)
    {
        return $this->collector->collect($rawData);
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
     *
     * @return $this
     */
    public function setCollector(CollectorInterface $collector)
    {
        $this->collector = $collector;

        return $this;
    }

    public function addCollector(CollectorInterface $collector)
    {
        if (!($this->collector instanceof BatchCollectorInterface)) {
            throw new \RuntimeException(sprintf(
                'Current base collector of class %s does not implement %s interface, therefore you cannot add child collector using %s method',
                get_class($this->collector), 'BatchCollectorInterface', __METHOD__
            ));
        }

        $this->collector->addCollector($collector);

        return $this;
    }
}
