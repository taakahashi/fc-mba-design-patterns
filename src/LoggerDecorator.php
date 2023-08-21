<?php

namespace App;

class LoggerDecorator implements UseCase
{

    public function __construct(
        readonly UseCase $useCase
    ) {
    }

    public function execute(Input $input)
    {
        return $this->useCase->execute($input);
    }
}