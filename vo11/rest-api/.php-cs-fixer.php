<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/public')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/views')
    ->name('*.php');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER-CS' => true,
    ])
    ->setFinder($finder);
