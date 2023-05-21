<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\Validation;
use Engine\Application;
use Engine\BisnessLogic;
use Engine\Request;
use FastRoute\RouteCollector;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE");

$dispatcher = \FastRoute\simpleDispatcher(function(RouteCollector $router) {
    $router->addGroup('/api', function (RouteCollector $router) {
        require_once __DIR__ . "/../routes/api.php";
    });
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo json_encode(["message" => "Method not found - ". $uri]);
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo json_encode(["message" => 'Method not allowed - '. $uri]);
        break;

    case FastRoute\Dispatcher::FOUND:

        $data = json_decode(file_get_contents("php://input"),true);

        $requestArr = [
            'routeInfo' => $routeInfo,
            'fields' => $data
        ];

        $request = json_encode($requestArr);

        $application = new Application(new BisnessLogic(), [
            new Authenticate(),
            new Validation(),
        ]);

        $request = new Request($request);
        $request = $application->handle($request);

        break;
}

die();