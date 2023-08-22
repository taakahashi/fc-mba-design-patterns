<?php

namespace Src\Infra\Repository;

use PDO;
use Src\Application\Repository\ContractRepository;
use Src\Domain\Contract;
use Src\Domain\Payment;
use Src\Infra\Database\DatabaseConnection;

class ContractDatabaseRepository implements ContractRepository
{

    public function __construct(
        readonly DatabaseConnection $connection
    ) {
    }

    /** @return Contract[] */
    public function list(): array {

        /** @var Contract[] $contracts */
        $contracts = [];

        $contractsData = $this->connection->query("SELECT * FROM contract;")->fetchAll(PDO::FETCH_ASSOC);

        foreach ($contractsData as &$contractData) {
            $contract = new Contract(
                $contractData["id_contract"],
                $contractData["description"],
                $contractData["amount"],
                $contractData["periods"],
                $contractData["date"]
            );

            $paymentsData = $this->connection
                ->query("SELECT * FROM payment WHERE id_contract = {$this->connection->quote($contractData['id_contract'])};")
                ->fetchAll(PDO::FETCH_ASSOC);


            foreach ($paymentsData as $paymentData) {
                $payment = new Payment(
                    $paymentData["id_contract"],
                    $paymentData["date"],
                    $paymentData["amount"]
                );

                $contract->addPayment($payment);
            }

            $contracts[] = $contract;
        }

        return $contracts;
    }
}