<?php

namespace tests;

use App\ContractDatabaseRepository;
use App\GenerateInvoices;
use App\Input;
use App\SQLiteAdapter;
use PHPUnit\Framework\TestCase;

class GenerateInvoicesTest extends TestCase
{
    private GenerateInvoices $generateInvoices;

    protected function setUp(): void
    {
        $connection = new SQLiteAdapter();
        $contractRepository = new ContractDatabaseRepository($connection);
        $this->generateInvoices = new GenerateInvoices($contractRepository);
    }

    public function testShouldGenerateInvoicesPerCashBasis()
    {
        $input = new Input(1, 2023, 'cash');
        $output = $this->generateInvoices->execute($input);

        $this->assertEquals("2023-01-01", $output[0]->date);
        $this->assertEquals(6000, $output[0]->amount);
    }

    public function testShouldGenerateInvoicesPerAccrualBasis()
    {
        $input = new Input(1, 2023, 'accrual');
        $output = $this->generateInvoices->execute($input);

        $this->assertEquals("2023-01-01", $output[0]->date);
        $this->assertEquals(500, $output[0]->amount);
    }

    public function testShouldGenerateInvoicesPerAccrualBasis1()
    {
        $input = new Input(2, 2023, 'accrual');
        $output = $this->generateInvoices->execute($input);

        $this->assertEquals("2023-02-01", $output[0]->date);
        $this->assertEquals(500, $output[0]->amount);
    }

    public function testShouldGenerateInvoicesPerAccrualBasisByCSVFile()
    {
        $input = new Input(2, 2023, 'accrual');
        $output = $this->generateInvoices->execute($input);

        $this->assertEquals("2023-02-01;500", $output[0]);
    }

}
