<?php

namespace App;

interface DatabaseConnection
{
    public function query(string $statement): mixed;

    public function quote(string $id);
}