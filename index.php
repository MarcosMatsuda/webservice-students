<?php

require './vendor/autoload.php';
require './config.php';

$config['displayErrorDetails'] = false;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = $servername;
$config['db']['user']   = $username;
$config['db']['pass']   = $password;
$config['db']['dbname'] = $dbname;

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);

    return $pdo;
};

$container['Student'] = function ($container) {
    $students = new \App\Controllers\Student($container);
    return $students;
};

require './app/routes.php';

$app->run();

