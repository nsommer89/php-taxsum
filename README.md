# php-taxsum
## About
A library in PHP to calculate taxes forth and back. Can calculate the amount of VAT on a price and calculate the VAT amount of a price, where VAT is already added.
## Installation

`composer require nsommer89/php-taxsum`

## Library usage
```
<?php
use Nsommer89\PhpTaxsum\Taxsum;
$taxsum = new Taxsum(25.00); // VAT percent in Denmark is 25% on purchases

// Add VAT to a price and get the price including 25% VAT
echo 250.00 + $taxsum->forth(250.00); // 250.00 + 62.50 = 312.50

// Calculate the VAT back to the price without VAT
echo 312.50 - $taxsum->back(312.50); // 312.50 - 62.50 = 250.00
```
## CLI usage

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