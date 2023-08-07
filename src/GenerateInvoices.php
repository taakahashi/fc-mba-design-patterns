<?php

namespace App;

use SQLite3;

class GenerateInvoices
{

    public function execute()
    {
        $db = new SQLite3('database.sqlite', SQLITE3_OPEN_READWRITE, '');
        $result = $db->query("SELECT * FROM contract;")->fetchArray(SQLITE3_ASSOC);
        \var_dump($result);

        return [];
    }

}