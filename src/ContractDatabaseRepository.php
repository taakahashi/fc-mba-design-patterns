<?php

namespace App;

use PDO;

class ContractDatabaseRepository implements ContractRepository
{

    public function list(): array
    {
        $db = new PDO('sqlite:database.sqlite');
        $contracts = $db->query("SELECT * FROM contract;")->fetchAll(PDO::FETCH_ASSOC);

        foreach ($contracts as &$contract) {
            $contract["payments"] = $db
                ->query("SELECT * FROM payment WHERE id_contract = {$db->quote($contract['id_contract'])};")
                ->fetchAll(PDO::FETCH_ASSOC);
        }

        return $contracts;
    }
}