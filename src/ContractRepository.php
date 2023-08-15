<?php

namespace App;

interface ContractRepository
{
    /** @return Contract[] */
    public function list(): array;
}