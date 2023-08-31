<?php

namespace Src\Infra\Mediator;

class Mediator
{
    private array $observers = [];

    public function __construct()
    {
        $this->observers = [];
    }

    public function on($event, $callback): void
    {
        $this->observers[] = ['event' => $event, 'callback' => $callback];
    }

    public function publish($event, $data): void
    {
        foreach ($this->observers as $observer) {
            if ($observer['event'] === $event) {
                call_user_func($observer['callback'], $data);
            }
        }
    }
}