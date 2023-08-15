<?php

namespace App;

class Contract
{
    /** @var Payment[] $payments */
    private array $payments;

    public function __construct(
        readonly string $idContract,
        readonly string $description,
        readonly float $amount,
        readonly int $periods,
        readonly string $date,
        array $payments = []
    ) {
    }

    public function addPayment(Payment $payment): void
    {
        $this->payments[] = $payment;
    }

    public function getPayments(): array
    {
        return $this->payments;
    }

    public function generateInvoices(int $month, int $year, string $type): array
    {
        /** @var Invoice[] $invoices */
        $invoices = [];

        if ($type === 'cash') {
            foreach ($this->getPayments() as $payment) {
                $date = strtotime($payment->date);

                if (date('m', $date) != $month || date('Y', $date) != $year) continue;

                $invoices[] = new Invoice(date('Y-m-d', $date), $payment->amount);
            }
        }

        if ($type === 'accrual') {
            $period = 0;

            while ($period < $this->periods) {
                $date = strtotime("+$period month", strtotime($this->date));
                $period++;

                if (date('m', $date) != $month || date('Y', $date) != $year) continue;

                $amount = $this->amount / $this->periods;

                $invoices[] = new Invoice(date('Y-m-d', $date), $amount);
            }
        }

        return $invoices;
    }
}