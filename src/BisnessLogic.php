<?php

declare(strict_types=1);

namespace Engine;

final class BisnessLogic implements Handler
{
    public function handle(Request $request): Response
    {
        $controller = $request->data['routeInfo'][1][0];
        $method = $request->data['routeInfo'][1][1];

        $vars = $request->data['routeInfo'][2];

        $handler = new $controller;
        $handler->$method($request);

        return new Response('Ok');
    }
}