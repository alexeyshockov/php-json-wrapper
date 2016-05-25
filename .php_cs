<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__ . '/src');

return Symfony\CS\Config\Config::create()
    ->setUsingCache(false)
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->finder($finder);
