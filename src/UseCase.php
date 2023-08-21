<?php

namespace App;

interface UseCase
{
    public function execute(Input $input);
}