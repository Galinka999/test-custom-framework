<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Engine\Middleware;
use Engine\Request;
use Engine\Response;

final class Authenticate implements Middleware
{
    public function handle(Request $request, callable $next): Response
    {
        if($request->token != $_ENV['AUTH_TOKEN_CLIENT']) {
            $response = json_encode([
                'status' => 'error',
                'message' => 'Invalid token'
            ]);
            echo $response;
            die();
        }

        return $next($request);
    }
}