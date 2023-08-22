<?php

namespace Src\Domain;

class Invoice
{
    public function __construct(
        readonly string $date,
        readonly float $amount
    ) {
    }
}