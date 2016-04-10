<?php

use Symfony\CS\Config\Config;
use Symfony\CS\Finder\DefaultFinder;

$finder =  DefaultFinder::create()
            ->in('lib')
            ->in('example')
            ->in('test');

$fixers = [
    '-braces',
    '-concat_without_spaces'
];

$config = Config::create()
            ->fixers($fixers)
            ->finder($finder);

return $config;
