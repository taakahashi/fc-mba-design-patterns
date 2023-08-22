<?php

namespace Src\Application\Presenter;

use Src\Application\UseCase\Output;

interface Presenter
{
    /** @param Output[] $output */
    public function present(array $output): mixed;
}