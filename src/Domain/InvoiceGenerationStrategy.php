<?php

namespace Src\Domain;

interface InvoiceGenerationStrategy
{
    /**
     * @return Invoice[]
     */
    public function generate(Contract $contract, int $month, int $year): array;
}