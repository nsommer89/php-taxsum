<?php
use PHPUnit\Framework\TestCase;
use Nsommer89\PhpTaxsum\Taxsum;

class TaxsumOptionsTest extends TestCase {

    public function testCanSetCurrency() {
        $taxsum = new Taxsum(25, [
            'currency' => 'DKK',
        ]);

        $this->assertEquals('DKK', $taxsum->getOptions()['currency']);
    }

    public function testCanSetCurrencySpace() {
        $taxsum = new Taxsum(25, [
            'currency_space' => true,
        ]);

        $this->assertEquals(true, $taxsum->getOptions()['currency_space']);
    }

    public function testCanSetDecimals() {
        $taxsum = new Taxsum(25, [
            'decimals' => 2,
        ]);

        $this->assertEquals(2, $taxsum->getOptions()['decimals']);
    }

    public function testCanSetCurrencyPosition() {
        $taxsum = new Taxsum(25, [
            'currency_position' => 'before',
        ]);

        $this->assertEquals('before', $taxsum->getOptions()['currency_position']);
    }

    public function testCanSetDecimalSeparator() {
        $taxsum = new Taxsum(25, [
            'decimal_separator' => ',',
        ]);

        $this->assertEquals(',', $taxsum->getOptions()['decimal_separator']);
    }

    public function testCanSetThousanSeparator() {
        $taxsum = new Taxsum(25, [
            'thousands_separator' => '.',
        ]);

        $this->assertEquals('.', $taxsum->getOptions()['thousands_separator']);
    }

}