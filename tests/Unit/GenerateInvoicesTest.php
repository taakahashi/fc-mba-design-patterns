<?php

use App\GenerateInvoices;
use PHPUnit\Framework\TestCase;

class GenerateInvoicesTest extends TestCase
{

    public function testShouldGenerateInvoices()
    {
        $generateInvoices = new GenerateInvoices();
        $output = $generateInvoices->execute();

        $this->assertCount(0, $output);
    }

}
