# Recursive Require

[![Latest Stable Version](https://poser.pugx.org/corpus/recursive-require/version)](https://packagist.org/packages/corpus/recursive-require)
[![License](https://poser.pugx.org/corpus/recursive-require/license)](https://packagist.org/packages/corpus/recursive-require)


Library to Recursively Require Every PHP File in a Directory Tree

## Requirements

- **php**: >=7.1.0

## Installing

Install the latest version with:

```bash
composer require 'corpus/recursive-require'
```

## Example

WIP

## Documentation

### Class: \Corpus\RecursiveRequire\Loader

#### Method: Loader->__construct

```php
function __construct($path)
```

##### Parameters:

- ***string*** `$path` - Root path

---

#### Method: Loader->__invoke

```php
function __invoke([ $regex = "/\\.php$/"])
```

Trigger the require's

##### Parameters:

- ***string*** `$regex`

##### Returns:

- ***array*** - The result as a map of filename to return value.