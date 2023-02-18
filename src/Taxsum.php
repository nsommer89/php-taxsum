<?php
namespace Nsommer89\PhpTaxsum;

use Exception;

class Taxsum {
    private float $tax_percent;

    public function __construct($tax_percent = null)
    {
        if ($tax_percent == null) {
            throw new Exception("Please provide the TaxSum library constructor method a tax percent to work with.");
        }

        if (!is_numeric($tax_percent)) {
            throw new Exception("Tax percent must be a valid integer or float.");
        }

        $this->tax_percent = floatval($tax_percent);

        if ($this->tax_percent <= 0) {
            throw new Exception("Tax percent must be a positive number. Got {$this->tax_percent}");
        }
    }

    public function forth($amount = 0.00) {
        return floatval($amount > 0 ? $amount * ($this->tax_percent / 100) : 0);
    }

    public function back($amount = 0.00) {
        return floatval($amount > 0 ? ($amount / (100 + $this->tax_percent) * $this->tax_percent) : 0);
    }
}