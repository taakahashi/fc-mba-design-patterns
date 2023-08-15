<?php

namespace tests;

use App\ContractDatabaseRepository;
use App\GenerateInvoices;
use App\Input;
use App\SQLiteAdapter;
use PHPUnit\Framework\TestCase;

class GenerateInvoicesTest extends TestCase
{

    public function testShouldGenerateInvoicesPerCashBasis()
    {
        $connection = new SQLiteAdapter();
        $contractRepository = new ContractDatabaseRepository($connection);
        $generateInvoices = new GenerateInvoices($contractRepository);

        $input = new Input(1, 2023, 'cash');
        $output = $generateInvoices->execute($input);

        $this->assertEquals("2023-01-01", $output[0]->date);
        $this->assertEquals(6000, $output[0]->amount);
    }

    public function testShouldGenerateInvoicesPerAccrualBasis()
    {
        $connection = new SQLiteAdapter();
        $contractRepository = new ContractDatabaseRepository($connection);
        $generateInvoices = new GenerateInvoices($contractRepository);

        $input = new Input(1, 2023, 'accrual');
        $output = $generateInvoices->execute($input);

        $this->assertEquals("2023-01-01", $output[0]->date);
        $this->assertEquals(500, $output[0]->amount);
    }

    public function testShouldGenerateInvoicesPerAccrualBasis1()
    {
        $connection = new SQLiteAdapter();
        $contractRepository = new ContractDatabaseRepository($connection);
        $generateInvoices = new GenerateInvoices($contractRepository);

        $input = new Input(2, 2023, 'accrual');
        $output = $generateInvoices->execute($input);

        $this->assertEquals("2023-02-01", $output[0]->date);
        $this->assertEquals(500, $output[0]->amount);
    }

}
