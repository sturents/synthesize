# Synthesize

Synthesizer trait to auto generate getter and setter access for objects.

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
		'description' => array('type' => 'string')
	};
}

$objTransaction = new Transaction();

$objTransaction->amount = 19.95;
$objTransaction->description = '4x Large Bowls';
```