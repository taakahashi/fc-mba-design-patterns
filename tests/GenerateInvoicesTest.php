<?php

namespace tests;

use App\ContractDatabaseRepository;
use App\CsvPresenter;
use App\GenerateInvoices;
use App\Input;
use App\JsonPresenter;
use App\SQLiteAdapter;
use PHPUnit\Framework\TestCase;
use PHPUnit\Util\Json;

class GenerateInvoicesTest extends TestCase
{
    private GenerateInvoices $generateInvoices;
    private ContractDatabaseRepository $contractRepository;

    protected function setUp(): void
    {
        $connection = new SQLiteAdapter();
        $this->contractRepository = new ContractDatabaseRepository($connection);
        $this->generateInvoices = new GenerateInvoices($this->contractRepository);
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
        $input = new Input(2, 2023, 'accrual', 'csv');
        $generateInvoices = new GenerateInvoices($this->contractRepository, new CsvPresenter());
        $output = $generateInvoices->execute($input);

        $this->assertEquals("2023-02-01;500", $output);
    }

}
