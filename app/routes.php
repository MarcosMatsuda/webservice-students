<?php

$app->get('/', \Student::class . ':index');
$app->get('/{id:[0-9]+}', \Student::class . ':show');
$app->put('/{id:[0-9]+}', \Student::class . ':update');
?>