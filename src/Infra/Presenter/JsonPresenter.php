<?php

namespace Src\Infra\Presenter;

use Src\Application\Presenter\Presenter;

class JsonPresenter implements Presenter
{

    public function present(array $output): array
    {
        return $output;
    }
}