<?php

declare(strict_types=1);

namespace Engine;

interface Middleware
{
    /**
     * @param Request $request
     * @param callable(Request): Response $next
     * @return Response
     */
    public function handle(Request $request, callable $next): Response;
}