# PRE
PHP-s print_r alternative

## Installation
This project using composer.
```
$ composer require kriit24/pre:*
```

## Usage
pre.
```php
<?php

use function kriit24\pre;

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