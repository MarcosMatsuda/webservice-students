<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\Controller;

class Student{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function index( Request $request, Response $response )
    {
        try
        {
            $statement = $this->container->db->prepare("SELECT * FROM students");
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return json_encode($results);

        }
        catch(PDOException $e)
        {
            print $e->getMessage();
        }

    }

    public function create( Request $request, Response $response )
    {

    }

    public function show( Request $request, Response $response, $args )
    {
        $id = $args['id'];

        $sql = "SELECT * FROM students WHERE id = :id";
        $sth = $this->container->db->prepare($sql);
        $sth->bindParam(':id', $args['id'], \PDO::PARAM_INT);
        $sth->execute();

        $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
        $json = json_encode($results);
        $return = $response->withJson([$results], 200)
            ->withHeader('Content-type', 'application/json');

        return $return;
    }

    public function update( Request $request, Response $response, $args )
    {
        $id = $args['id'];
        $name = $request->getParam('name');
        $age = $request->getParam('age');
        $gender = $request->getParam('gender');

        var_dump($name);


        die('update');

        $sql = "UPDATE students SET fullname = :fullname, age = :age, gender = :gender WHERE id = :id";
        $statement = $this->container->db->prepare($sql);

        $statement->bindParam(":fullname", $name, \PDO::PARAM_STR);
        $statement->bindParam(":age",$age, \PDO::PARAM_STR);
        $statement->bindParam(":gender", $gender, \PDO::PARAM_STR);
        $statement->bindParam(":id", $id, \PDO::PARAM_INT);
        $statement->execute();

        $return = $response->withJson(['msg' => "Operação realizada com sucesso."], 400)
            ->withHeader('Content-type', 'application/json');

        return $return;
    }

    public function destroy( Request $request, Response $response )
    {
        $id = $args['id'];

        $sql = "DELETE FROM students where id = :id";
        $this->db->prepare($sql);
        $sth->bindParam(':id', $args['id'], \PDO::PARAM_INT);
        $sth->execute();

        $return = $response->withJson(['msg' => $sth->rowCount() . " registro(s) deletado(s) com sucesso."], 200)
        ->withHeader('Content-type', 'application/json');

        return $return;

    }



}