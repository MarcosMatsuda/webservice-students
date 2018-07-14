<?php

include_once 'controllers/Student.php';

$container['Student'] = function ($container) {
    $students = new App\Controllers\Student($container);
    return $students;
};

// CORS
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/', \Student::class . ':index');
$app->post('/', \Student::class . ':create');
$app->get('/{id:[0-9]+}', \Student::class . ':show');
$app->put('/{id:[0-9]+}', \Student::class . ':update');
$app->delete('/{id:[0-9]+}', \Student::class . ':destroy');
