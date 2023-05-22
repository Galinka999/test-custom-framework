<?php

declare(strict_types=1);

namespace Engine;

interface Handler
{
    public function handle(Request $request): void;
}