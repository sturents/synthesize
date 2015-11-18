# Synthesize

Synthesizer trait to auto generate getter and setter access for objects.

[![Latest Stable Version](https://img.shields.io/packagist/v/frozensheep/synthesize.svg?style=flat-square)](https://packagist.org/frozensheep/synthesize)
[![Build Status](https://img.shields.io/travis/frozensheep/synthesize/master.svg?style=flat-square)](https://img.shields.io/travis/frozensheep/synthesize.svg)
[![MIT License](https://img.shields.io/packagist/l/frozensheep/synthesize.svg?style=flat-square)](https://packagist.org/frozensheep/synthesize)
[![PHP 5.4](https://img.shields.io/badge/php-5.4-8892BF.svg?style=flat-square)](https://php.net/)
[![PHP 5.5](https://img.shields.io/badge/php-05.5-8892BF.svg?style=flat-square)](https://php.net/)
[![PHP 5.6](https://img.shields.io/badge/php-5.6-8892BF.svg?style=flat-square)](https://php.net/)
[![PHP 7](https://img.shields.io/badge/php-7-8892BF.svg?style=flat-square)](https://php.net/)


## Install

To install with Composer:

```sh
composer require frozensheep/synthesize
```

## Usage

```php
use Frozensheep\Synthesize\Synthesizer;

class Transaction {

	use Synthesizer;

	protected $arrSynthesize = array(
		'amount' => array('type' => 'float'),
		'description' => array('type' => 'string', 'default' => 'Super cool product.')
	};
}

$objTransaction = new Transaction();

$objTransaction->amount = 19.95;
$objTransaction->description = '4x Large Bowls';
```