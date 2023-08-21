<?php

namespace App;

interface Presenter
{
    /** @param Output[] $output */
    public function present(array $output): mixed;
}