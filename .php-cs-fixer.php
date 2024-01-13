<?php

$finder = \PhpCsFixer\Finder::create()
        ->in(__DIR__)
        ->name('*.php')
        ->ignoreDotFiles(true);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'blank_line_before_statement' => [
            'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try']
        ]
    ])
    ->setFinder($finder);
