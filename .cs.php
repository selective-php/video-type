<?php

use PhpCsFixer\Config;

return (new Config())
  ->setUsingCache(false)
  ->setRiskyAllowed(true)
  ->setRules([
    '@PSR1' => true,
    '@PSR2' => true,
    '@Symfony' => true,
    'psr_autoloading' => true,
    'yoda_style' => [
        'equal' => false,
        'identical' => false,
        'less_and_greater' => false
    ],
    'array_syntax' => ['syntax' => 'short'],
    'list_syntax' => ['syntax' => 'short'],
    'concat_space' => ['spacing' => 'one'],
    'cast_spaces' => ['space' => 'none'],
    'compact_nullable_type_declaration' => true,
    'increment_style' => ['style' => 'post'],
    'declare_equal_normalize' => ['space' => 'single'],
    'echo_tag_syntax' => ['format' => 'long'],
    'protected_to_private' => false,
    'phpdoc_align' => false,
    'phpdoc_add_missing_param_annotation' => ['only_untyped' => false],
    'phpdoc_order' => true, // psr-5
    'phpdoc_no_useless_inheritdoc' => false,
    'phpdoc_no_empty_return' => false,
    'phpdoc_to_comment' => false,
    'no_superfluous_phpdoc_tags' => false,
    'align_multiline_comment' => true, // psr-5
    'general_phpdoc_annotation_remove' => [
      'annotations' => [
        'author',
        'package',
      ],
    ],
    'global_namespace_import' => [
        'import_classes' => true,
        'import_constants' => null,
        'import_functions' => null
    ],
  ])
  ->setFinder(PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
);
