<?php

namespace App;

class JsonPresenter implements Presenter
{

    public function present(array $output): array
    {
        return $output;
    }
}