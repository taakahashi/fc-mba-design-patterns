<?php

use PHPUnit\Framework\TestCase;
use Src\Domain\Contract;
use Src\Domain\Payment;

class ContractTest extends TestCase
{
    public function testShouldGenerateInvoiceOfAContract()
    {
        $contract = new Contract(
            "",
            "",
            6000,
            12,
            "2023-01-01 00:00:00"
        );

        $invoices = $contract->generateInvoices(1, 2023, 'accrual');

        $this->assertEquals("2023-01-01", $invoices[0]->date);
        $this->assertEquals(500, $invoices[0]->amount);
    }

    public function testShouldCalculateBalanceOfAContract()
    {
        $contract = new Contract(
            "",
            "",
            6000,
            12,
            "2023-01-01 00:00:00"
        );

        $contract->addPayment(new Payment("", "2023-01-01 00:00:00", 2000));

        $this->assertEquals(4000, $contract->getBalance());
    }
}
