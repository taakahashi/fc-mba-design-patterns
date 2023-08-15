<?php

namespace App;

use PDO;

class SQLiteAdapter implements DatabaseConnection
{

    private PDO $connection;

    public function __construct() {
        $this->connection = new PDO('sqlite:database.sqlite');
    }

    public function query(string $statement): bool|\PDOStatement {
        return $this->connection->query($statement);
    }

    public function quote(string $id): bool|string
    {
        return $this->connection->quote($id);
    }
}