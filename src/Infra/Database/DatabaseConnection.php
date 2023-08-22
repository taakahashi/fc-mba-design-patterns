<?php

namespace Src\Infra\Database;

interface DatabaseConnection
{
    public function query(string $statement): mixed;

    public function quote(string $id);
}