<?php

namespace Src\Application\UseCase;

interface UseCase
{
    public function execute(Input $input);
}