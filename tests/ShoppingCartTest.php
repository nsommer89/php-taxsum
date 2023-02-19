<?php
use PHPUnit\Framework\TestCase;
use Nsommer89\PhpTaxsum\Taxsum;

require_once __DIR__ . '/../vendor/autoload.php';

// ShoppingCart test class
class ShoppingCartTest extends TestCase {

    public function testThousandsSeparatorCannotHaveMoreThanOneCharacter() {
        $this->expectException(\Exception::class);
        $taxsum = new Taxsum(25, [
            'thousands_separator' => '..',
        ]);
    }

    public function testDecimalSeparatorCannotHaveMoreThanOneCharacter() {
        $this->expectException(\Exception::class);
        $taxsum = new Taxsum(25, [
            'decimal_separator' => '..',
        ]);
    }
}