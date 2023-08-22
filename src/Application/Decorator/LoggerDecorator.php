<?php

namespace Src\Application\Decorator;

use Src\Application\UseCase\Input;
use Src\Application\UseCase\UseCase;

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