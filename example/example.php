<?php

use Corpus\RecursiveRequire\Loader;

require __DIR__ . '../vendor/autoload.php';

$loader = new Loader('path/to/directory');
$loader();
