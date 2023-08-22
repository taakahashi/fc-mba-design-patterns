<?php

namespace Src\Domain;

class CashBasisStrategy implements InvoiceGenerationStrategy
{

    public function generate(Contract $contract, int $month, int $year): array
    {
        /** @var Invoice[] $invoices */
        $invoices = [];

        foreach ($contract->getPayments() as $payment) {
            $date = strtotime($payment->date);

            if (date('m', $date) != $month || date('Y', $date) != $year) continue;

            $invoices[] = new Invoice(date('Y-m-d', $date), $payment->amount);
        }

        return $invoices;
    }
}