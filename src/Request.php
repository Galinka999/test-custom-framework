<?php

declare(strict_types=1);

namespace Engine;

final class Request
{
    public array $params;
    public string $token;
    public array $data;

    public function __construct($data)
    {
        $data = json_decode($data, true);
        $this->data = $data;

        $this->parseRequest();
    }

    protected function parseRequest()
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $arr = explode(" ", $authHeader);
        $this->token = $arr[1];
    }
}