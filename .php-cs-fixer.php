<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['storage', 'bootstrap/cache'])
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();

return $config->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;