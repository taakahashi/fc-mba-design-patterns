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

    public function getBalance(): float
    {
        $balance = $this->amount;
        foreach ($this->payments as $payment) {
            $balance -= $payment->amount;
        }

        return $balance;
    }

    public function generateInvoices(int $month, int $year, string $type): array
    {
        $invoiceGenerationStrategy = InvoiceGenerationFactory::create($type);

       return $invoiceGenerationStrategy->generate($this, $month, $year);
    }
}