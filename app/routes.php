<?php

include_once 'controllers/Student.php';

$container['Student'] = function ($container) {
    $students = new App\Controllers\Student($container);
    return $students;
};

$app->get('/', \Student::class . ':index');
$app->post('/', \Student::class . ':create');
$app->get('/{id:[0-9]+}', \Student::class . ':show');
$app->put('/{id:[0-9]+}', \Student::class . ':update');
$app->delete('/{id:[0-9]+}', \Student::class . ':destroy');
