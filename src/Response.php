<?php

declare(strict_types=1);

namespace Engine;

final class Response
{
    public string $status;

    public function __construct($status)
    {
        $this->status = $status;
    }
}