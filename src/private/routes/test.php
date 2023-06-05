<?php
$router::RouteGroup([\PMP\Middleware\Session::class],[
    $router::Map('GET', '/', 'TestController::Hello', 'test.hello'),
    $router::RouteGroup([\PMP\Middleware\RequestBodyJson::class],[
        $router::Map('GET', '/csrf', 'TestController::Hello', 'test.csrf')->PushMiddlewares([\PMP\Middleware\CSRF2Middleware::class])
    ]),
]);
$router::Map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'LOCK'], '/json', ['TestController' => 'JSON'], 'test.json')->PushMiddlewares([\PMP\Middleware\RequestBodyJson::class]);
$router::Map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'LOCK'], '/form', ['TestController' => 'Form'], 'test.form')->PushMiddlewares([\PMP\Middleware\RequestBodyForm::class]);
$router::Map('GET', '/time', [TestController::class => 'Time'], 'test.time')->PushMiddlewares([\PMP\Middleware\CORS2Middleware::class]);
$router::Map('GET', '/layout', ['TestController' => 'Layout'], 'test.layout');
$router::Map('GET', '/event', ['TestController' => 'Event']);
$router::Map('GET', '/param/[i:smthng]/alpha/[a:str]', 'TestController::ParamRoute', 'test.param');

$router::Map('GET', '/lang/get', 'LanguageTestController::Get');
$router::Map('GET', '/lang/set/[a:lang]', 'LanguageTestController::Set');
$router::Map('GET', '/lang/detect', 'LanguageTestController::Detect');

$router::Redirect('/red/1', 'https://google.com');
$router::Redirect('/red/2', '/layout');

$router::GET('/get', 'TestController::Layout');

$router::Map('GET', '*', ['TestController' => '_404', 'test.404']);