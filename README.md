# PRE
PHP-s print_r alternative

## Installation
This project using composer.
```
$ composer require kriit24/pre
```

## Usage
pre.
```php
<?php

//require in helper
require_once 'vendor/kriit24/pre/src/pre.php'; 

/*
 * USAGE
 * pre(array);
 * pre(object);
 * pre(string);
 * pre(array/object/string, console_style);
 * pre('note', array/object/string, console_style);
 */

pre([]);
```
