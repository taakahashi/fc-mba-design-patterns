<?php

namespace App;

use PDO;

class GenerateInvoices
{

    /**
     * @return Output[]
     */
    public function execute(Input $input): array
    {
        /** @var Output[] $outputArray */
        $outputArray = [];

        $contractRepository = new ContractDatabaseRepository();
        $contracts = $contractRepository->list();

        foreach ($contracts as $contract) {
            if ($input->type === 'cash') {
                foreach ($contract["payments"] as $payment) {
                    $date = strtotime($payment['date']);

                    if (date('m', $date) != $input->month || date('Y', $date) != $input->year) continue;

                    $outputArray[] = new Output(date('Y-m-d', $date), $payment['amount']);
                }
            }

            if ($input->type === 'accrual') {
                $period = 0;

                while ($period < $contract['periods']) {
                    $date = strtotime("+$period month", strtotime($contract['date']));
                    $period++;

                    if (date('m', $date) != $input->month || date('Y', $date) != $input->year) continue;

                    $amount = $contract['amount'] / $contract['periods'];

                    $outputArray[] = new Output(date('Y-m-d', $date), $amount);
                }
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
    )
    { }
}

class Output {
    public function __construct(
        public string $date,
        public float $amount
    )
    { }
}