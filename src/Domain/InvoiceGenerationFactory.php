<?php

namespace Src\Domain;

class InvoiceGenerationFactory
{
    public static function create(string $type): InvoiceGenerationStrategy
    {
        if ($type === 'cash') return new CashBasisStrategy();

        if ($type === 'accrual') return new AccrualBasisStrategy();

        throw new \Error("Invalid type");
    }
}