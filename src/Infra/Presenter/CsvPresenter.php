<?php

namespace Src\Infra\Presenter;

use Src\Application\Presenter\Presenter;
use Src\Application\UseCase\Output;

class CsvPresenter implements Presenter
{

    /** @param Output[] $output */
    public function present(array $output): string
    {
        $lines = [];
        foreach ($output as $data) {
            $line = [];

            $line[] = $data->date;
            $line[] = $data->amount;

            $lines[] = implode(';', $line);
        }

        return implode("\n", $lines);
    }
}