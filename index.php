<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once './db_desenvolvimento.php';
include_once './db_producao.php';
include './conexao.php';
require './vendor/autoload.php';

header("Content-Type: text/html; charset=ISO-8859-1",true);

$app = new \Slim\App;

try{
    $pdo = conexao( $servername, $dbname, $username, $password );
}catch( Exception $e ){
    //
}

/**
 * Lista de todos os students
 */
$app->get('/api', function (Request $request, Response $response) use ($app, $pdo) {
    $sth = $pdo->prepare("SELECT * FROM students");
    $sth->execute();

    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    $return = $response->withJson([$results], 200)
        ->withHeader('Content-type', 'application/json');    

    return $return;
});

/**
 * Retornando mais informações do students informado pelo id
 */
$app->get('/api/{id}', function (Request $request, Response $response, $args) use ($app, $pdo) {

    $sth = $pdo->prepare("SELECT * FROM students where id = :id");
    $sth->bindParam(':id', $args['id'], \PDO::PARAM_INT);
    $sth->execute();

    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    $return = $response->withJson([$results], 200)
        ->withHeader('Content-type', 'application/json');    

    return $return;
});

/**
 * Cadastra um novo students
 */
$app->post('/api', function (Request $request, Response $response) use ($app, $pdo) {
        
});

/**
 * Atualiza os dados de um students
 */
$app->put('/api/{id}', function (Request $request, Response $response) use ($app, $pdo) {
    
});

/**
 * Deleta o students informado pelo ID
 */
$app->delete('/api/{id}', function (Request $request, Response $response, $args) use ($app, $pdo) {
      
    try{
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $pdo->prepare("DELETE FROM students where id = :id");
        $sth->bindParam(':id', $args['id'], \PDO::PARAM_INT);
        $sth->execute();
        
        $return = $response->withJson(['msg' => $sth->rowCount() . " registro(s) deletado(s) com sucesso."], 200)
        ->withHeader('Content-type', 'application/json'); 
            
    }catch(Exception $e){

        $return = $response->withJson(['msg' => "Não foi possível deletar este registro."], 400)
            ->withHeader('Content-type', 'application/json'); 
    }
    return $return;
});

$app->run();


?>





