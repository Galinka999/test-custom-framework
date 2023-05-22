<?php

declare(strict_types=1);

namespace Engine;

final class Pipeline
{
    private Handler $handler;
    private array $middlewares;

    public function __construct(Handler $handler, array $middlewares)
    {
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    public function handle(Request $request)
    {
        $middlware = array_shift($this->middlewares);

        if($middlware != null) {
            $middlware->handle($request, [$this, 'handle']);
        }

        $this->handler->handle($request);
    }
}