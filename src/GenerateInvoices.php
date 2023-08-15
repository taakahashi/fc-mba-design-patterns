<?php

namespace App;


class GenerateInvoices
{

    public function __construct(
      readonly ContractRepository $contractRepository
    ) {
    }

    /**
     * @return Output[]
     */
    public function execute(Input $input): array
    {
        /** @var Output[] $outputArray */
        $outputArray = [];

        $contracts = $this->contractRepository->list();

        foreach ($contracts as $contract) {
            $invoices = $contract->generateInvoices($input->month, $input->year, $input->type);

            foreach ($invoices as $invoice) {
                $outputArray[] = new Output($invoice->date, $invoice->amount);
            }
        }

        return $outputArray;
    }
}

class Input {
    public function __construct(
        public int $month,
        public int $year,
        public string $type
    ) {
    }
}

class Output {
    public function __construct(
        public string $date,
        public float $amount
    ) {
    }
}