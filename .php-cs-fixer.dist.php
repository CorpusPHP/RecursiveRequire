<?php

use Corpus\PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
	->files()
	->in(__DIR__ . '/src')
	->in(__DIR__ . '/test')
	->in(__DIR__ . '/example')
	->name('*.php');

return Config::php7x4()->setFinder($finder);
