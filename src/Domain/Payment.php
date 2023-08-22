<?php

namespace Src\Domain;

class Payment
{
    public function __construct(
        readonly string $idContract,
        readonly string $date,
        readonly float $amount
    ) {
    }
}