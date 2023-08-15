<?php

namespace tests;

use App\Contract;
use App\Invoice;
use PHPUnit\Framework\TestCase;

class ContractTest extends TestCase
{
    public function testDeveGerarFaturasDeUmContrato()
    {
        $contract = new Contract("", "", 6000, 12, "2023-01-01 00:00:00");
        $invoices = $contract->generateInvoices(1, 2023, 'accrual');

        $this->assertEquals("2023-01-01", $invoices[0]->date);
        $this->assertEquals(500, $invoices[0]->amount);
    }
}
