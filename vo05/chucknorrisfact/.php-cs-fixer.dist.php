<?php

return (new PhpCsFixer\Config())
    ->setRules(['@PER-CS3x0' => true])
    ->setFinder((new PhpCsFixer\Finder())->in(__DIR__));