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
        /**
         * Sabemos que esse código está com várias responsabilidades misturadas,
         * como conexão de BD e regras de negócio, ferindo o SRP do SOLID, por exemplo.
         *
         * A ideia a seguir é refatorar esse código com alguns patterns.
         */

        $db = new PDO('sqlite:database.sqlite');
        $contracts = $db->query("SELECT * FROM contract;")->fetchAll(PDO::FETCH_ASSOC);

        /** @var Output[] $outputArray */
        $outputArray = [];

        foreach ($contracts as $contract) {
            if ($input->type === 'cash') {
                $payments = $db
                    ->query("SELECT * FROM payment WHERE id_contract = {$db->quote($contract['id_contract'])};")
                    ->fetchAll(PDO::FETCH_ASSOC);

                foreach ($payments as $payment) {
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