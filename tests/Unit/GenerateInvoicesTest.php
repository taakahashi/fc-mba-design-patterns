<?php

use App\GenerateInvoices;
use App\Input;
use PHPUnit\Framework\TestCase;

class GenerateInvoicesTest extends TestCase
{

    public function testShouldGenerateInvoicesPerCashBasis()
    {
        $generateInvoices = new GenerateInvoices();

        $input = new Input(1,  2023, 'cash');
        $output = $generateInvoices->execute($input);

        $this->assertEquals("2023-01-01", $output[0]->date);
        $this->assertEquals(6000, $output[0]->amount);
    }

    public function testShouldGenerateInvoicesPerAccrualBasis()
    {
        $generateInvoices = new GenerateInvoices();

        $input = new Input(1,  2023, 'accrual');
        $output = $generateInvoices->execute($input);

        $this->assertEquals("2023-01-01", $output[0]->date);
        $this->assertEquals(500, $output[0]->amount);
    }

    public function testShouldGenerateInvoicesPerAccrualBasis1()
    {
        $generateInvoices = new GenerateInvoices();

        $input = new Input(2,  2023, 'accrual');
        $output = $generateInvoices->execute($input);

        $this->assertEquals("2023-02-01", $output[0]->date);
        $this->assertEquals(500, $output[0]->amount);
    }

}