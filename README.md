# php-taxsum
## About
A library in PHP to calculate taxes forth and back. Can calculate the amount of VAT on a price and calculate the VAT amount of a price, where VAT is already added.
## Requirements
Minimum ` >= php8.0`
## Installation with Composer
`composer require nsommer89/php-taxsum`

.. or github page: https://github.com/nsommer89/php-taxsum

## Library usage
```
<?php
require_once __DIR__ . '/path/to/autoload.php';

use Nsommer89\PhpTaxsum\Taxsum;

$taxsum = new Taxsum(25.00); // VAT percent in Denmark is 25% on purchases

// Add VAT to a price and get the price including 25% VAT
echo 250.00 + $taxsum->forth(250.00); // 250.00 + 62.50 = 312.50

// Calculate the VAT back to the price without VAT
echo 312.50 - $taxsum->back(312.50); // 312.50 - 62.50 = 250.00
```

#### Adding options to the constructor
```
// ...
$taxsum = new Taxsum(25.00, [
   'currency' => 'DKK', //
   'currency_space' => true
   'decimals' => 2,
   'currency_position' => 'before', // before or after
   'decimal_separator' => ',',
   'thousands_separator' => '.',
]);
// ...
```
#### Explanation of options
`currency` €|$|£|DKK|NOK|SEK etc. `null` for disabled

`currency_space` Adds space between currency and amount

`decimals` The number of decimals for output

`currency_position` Add the currency before or after the er amount

`decimal_separator` The character which separate the decimal from number

`thousands_separator` The character which indicate thousands

## CLI usage

Overall usage
```
$ ./vendor/bin/taxsum <method> <tax> <amount>
<result>
```

Calculate forth
```
$ ./vendor/bin/taxsum forth 25 250.00
62.50
```

Calculate back
```
$ ./vendor/bin/taxsum back 25 312.50
62.50
```

Made with ♡ by nsommer89