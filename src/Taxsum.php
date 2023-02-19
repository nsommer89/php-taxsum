<?php
namespace Nsommer89\PhpTaxsum;

/**
 * Class Taxsum - PHP Taxsum library for calculating tax amounts and amounts without tax.
 * This class is used to calculate the tax amount of a given amount.
 * It can also calculate the amount without tax from a given amount with tax.
 * All calculations are based on the given tax percent.
 * By default, the output is formatted to two decimal places.
 * Example options:
 * [
 *    'currency' => 'DKK', // €|$|£|DKK|NOK|SEK etc.
 *    'currency_space' => true|false,
 *    'decimals' => 2,
 *    'currency_position' => 'before|after',
 *    'decimal_separator' => ',',
 *    'thousands_separator' => '.',
 * ]
 * @author nsommer89
 * @link http://github.com/nsommer89/php-taxsum
 * @package Nsommer89\PhpTaxsum
 * @version 1.0.0
 * @license MIT
 */
class Taxsum {
    /**
     * @var float
     */
    private float $tax_percent;

    /**
     * @var array
     */
    private array $options = [];

    /**
     * @var array
     */
    private array $_defaults = [
        'currency' => '$',
        'currency_space' => true,
        'decimals' => 2,
        'currency_position' => 'before',
        'decimal_separator' => ',',
        'thousands_separator' => '.',
    ];

    /**
     * Taxsum constructor.
     * @param float|null $tax_percent
     * @throws \Exception
     */
    public function __construct(float $tax_percent = null, array $options = [])
    {
        $this->validateTaxPercent($tax_percent);
        $this->setTaxPercent($tax_percent);
        $this->setOptions($options);
    }

    /**
     * @param float|null $tax_percent
     * @return void
     */
    private function setTaxPercent(float $tax_percent = null) : void {
        $this->tax_percent = floatval($tax_percent);
    }

    /**
     * @param array $options
     * @return void
     */
    private function setOptions($options = []) : void {
        $this->options = array_merge($this->_defaults, $options);

        if (!is_numeric($this->options['decimals'])) {
            throw new \Exception('Decimals must be a valid integer.');
        }

        if ($this->options['decimals'] < 0) {
            throw new \Exception('Decimals must be a positive number.');
        }

        if (!is_string($this->options['decimal_separator'])) {
            throw new \Exception('Decimal separator must be a string.');
        }

        if (!is_string($this->options['thousands_separator'])) {
            throw new \Exception('Thousands separator must be a string.');
        }

        if (strlen($this->options['decimal_separator']) > 1) {
            throw new \Exception('Decimal separator must be a single character.');
        }

        if (strlen($this->options['thousands_separator']) > 1) {
            throw new \Exception('Thousands separator must be a single character.');
        }

        if ($this->options['decimal_separator'] == $this->options['thousands_separator']) {
            throw new \Exception('Decimal separator and thousands separator must be different characters.');
        }

        if ($this->options['currency'] != null) {
            if (!is_string($this->options['currency'])) {
                throw new \Exception('Currency must be a string.');
            }
    
            if (strlen($this->options['currency']) > 3) {
                throw new \Exception('Currency must be a maximum of 3 characters.');
            }

            if (!in_array($this->options['currency_position'], ['before', 'after'])) {
                throw new \Exception('Currency position must be either "before" or "after".');
            }
        }
    }

    /**
     * @param float|null $tax_percent
     * @throws \Exception
     * @return void
     */
    private function validateTaxPercent(float $tax_percent) : void {
        if ($tax_percent == null) {
            throw new \Exception('Please provide the TaxSum library constructor method a tax percent to work with.');
        }

        if (!is_numeric($tax_percent)) {
            throw new \Exception('Tax percent must be a valid integer or float.');
        }

        if ($tax_percent <= 0) {
            throw new \Exception('Tax percent must be a positive number.');
        }
    }

    /**
     * @param float $amount
     * @return float
     */
    public function forth($amount = 0.00) : string {
        return $this->formatOutput($amount > 0 ? $amount * ($this->tax_percent / 100) : 0);
    }

    /**
     * @param float $amount
     * @return float
     */
    public function back($amount = 0.00) : string {
        return $this->formatOutput($amount > 0 ? ($amount / (100 + $this->tax_percent) * $this->tax_percent) : 0);
    }

    /**
     * @param float $amount
     * @return float
     */
    private function formatOutput($amount = 0.00) : string {
        $value = number_format(
            floatval($amount),
            $this->options['decimals'],
            $this->options['decimal_separator'],
            $this->options['thousands_separator']
        );

        if ($this->options['currency'] != null) {
            $currency_space = $this->options['currency_space'] === true ? ' ' : '';
            $value = $this->options['currency_position'] == 'before'
            ? $this->options['currency'] . $currency_space . $value
            : $value . $currency_space . $this->options['currency'];
        }

        return $value;
    }
}