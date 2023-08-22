<?php

namespace Src\Application\Repository;

use Src\Domain\Contract;

interface ContractRepository
{
    /** @return Contract[] */
    public function list(): array;
}