<?php

declare(strict_types=1);

namespace Engine;

final class Application
{
    private Handler $handler;
    private array $middlewares;

    public function __construct(Handler $handler, array $middlewares)
    {
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    public function handle(Request $request): Response
    {
        return (new Pipeline($this->handler, $this->middlewares))->handle($request);
    }
}