<?php

namespace App;

class AccrualBasisStrategy implements InvoiceGenerationStrategy
{

    public function generate(Contract $contract, int $month, int $year): array
    {
        /** @var Invoice[] $invoices */
        $invoices = [];

        $period = 0;

        while ($period < $contract->periods) {
            $date = strtotime("+$period month", strtotime($contract->date));
            $period++;

            if (date('m', $date) != $month || date('Y', $date) != $year) continue;

            $amount = $contract->amount / $contract->periods;

            $invoices[] = new Invoice(date('Y-m-d', $date), $amount);
        }

        return $invoices;
    }
}