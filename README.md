# Recursive Require

[![Latest Stable Version](https://poser.pugx.org/corpus/recursive-require/version)](https://packagist.org/packages/corpus/recursive-require)
[![License](https://poser.pugx.org/corpus/recursive-require/license)](https://packagist.org/packages/corpus/recursive-require)
[![ci.yml](https://github.com/CorpusPHP/RecursiveRequire/actions/workflows/ci.yml/badge.svg)](https://github.com/CorpusPHP/RecursiveRequire/actions/workflows/ci.yml)


Library to Recursively Require Every PHP File in a Directory Tree

## Requirements

- **php**: >=7.4.0

## Installing

Install the latest version with:

```bash
composer require 'corpus/recursive-require'
```

## Usage

Here is a simple usage example:

```php
<?php

use Corpus\RecursiveRequire\Loader;

require __DIR__ . '../vendor/autoload.php';

$loader = new Loader('path/to/directory');
$loader();

```

## Documentation

### Class: \Corpus\RecursiveRequire\Loader

Helper to recursively require all PHP files in a directory

#### Method: Loader->__construct

```php
function __construct(string $path [, bool $once = false])
```

##### Parameters:

- ***string*** `$path` - Root path to recursively require
- ***bool*** `$once` - Whether to use `require_once` instead of `require`

---

#### Method: Loader->__invoke

```php
function __invoke([ string $regex = "/\\.php\$/"]) : array
```

Trigger the `require`(s)  
  
Note: The order in which files are required is not guaranteed.  
It will vary based on the Operating System and filesystem.  
Do not rely on the order in which files are required.

##### Parameters:

- ***string*** `$regex` - A regex to filter the files to require

##### Returns:

- ***array<string,mixed>*** - The result as a map of filename to return value.