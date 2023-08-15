<?php

namespace App;

class Invoice
{
    public function __construct(
        readonly string $date,
        readonly float $amount
    ) {
    }
}