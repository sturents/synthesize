# Synthesize

Synthesizer trait to auto generate getter and setter access for objects.

[![Latest Stable Version](https://img.shields.io/packagist/v/frozensheep/synthesize.svg?style=flat-square)](https://packagist.org/frozensheep/synthesize)
[![Build Status](https://img.shields.io/travis/frozensheep/synthesize/master.svg?style=flat-square)](https://img.shields.io/travis/frozensheep/synthesize.svg)

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