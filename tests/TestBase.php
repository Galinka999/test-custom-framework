<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TestBase extends TestCase
{
    protected HttpClientInterface $httpClient;
    protected string $auth;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->auth = $_ENV['AUTH_TOKEN_CLIENT'];

        $this->httpClient = HttpClient::create();
    }

}