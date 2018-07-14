<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Student{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function index(Request $request, Response $response )
    {
        try
        {
            $statement = $this->container->db->prepare("SELECT * FROM students");
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            $return = $response->withJson($results, 200)
                ->withHeader('Content-type', 'application/json');

        }
        catch(\Exception $e)
        {
            return $e->getMessage();
            //$return = $response->withJson("Operação não realizada.", 400)
                //->withHeader('Content-type', 'application/json');
        }

        return $return;

    }

    /**
     *
     * Headers:
     * Content-Type: application/json
     *
     * Body:
     * x-www-form-urlencoded
     *
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function create( Request $request, Response $response )
    {
        try{

            $params = $request->getParsedBody();

            if( is_null($params['name']) || is_null($params['gender']) || is_null($params['age'])  ){
                return $response->withJson("Operação não realizada.", 400)
                    ->withHeader('Content-type', 'application/json');
            }

            if( !is_numeric($params['age']) ){
                return $response->withJson("Operação não realizada.", 400)
                    ->withHeader('Content-type', 'application/json');
            }

            $sql = "INSERT INTO students (fullname, gender, age ) VALUES ( :fullname, :gender, :age);";

            $statement = $this->container->db->prepare($sql);
            $statement->bindParam(":fullname", $params['name'], \PDO::PARAM_STR);
            $statement->bindParam(":gender", $params['gender'], \PDO::PARAM_STR);
            $statement->bindParam(":age", $params['age'], \PDO::PARAM_INT);
            $statement->execute();

            $return = $response->withJson("Operação realizada com sucesso.", 200)
                ->withHeader('Content-type', 'application/json');

        }catch( \Exception $e ){

            $return = $response->withJson("Operação não realizada.", 400)
                ->withHeader('Content-type', 'application/json');
        }

        return $return;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function show(Request $request, Response $response, $args )
    {
        $sql = "SELECT * FROM students WHERE id = :id";
        $sth = $this->container->db->prepare($sql);
        $sth->bindParam(':id', $args['id'], \PDO::PARAM_INT);
        $sth->execute();

        $results = $sth->fetchAll(\PDO::FETCH_ASSOC);

        $return = $response->withJson($results, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;
    }


    /**
     *
     * Headers:
     * Content-Type: application/json
     *
     * Body:
     * x-www-form-urlencoded
     *
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function update(Request $request, Response $response, $args )
    {
        try{

            $params = $request->getParsedBody();

            $sql = "UPDATE students SET fullname = :fullname, age = :age, gender = :gender WHERE id = :id";
            $statement = $this->container->db->prepare($sql);

            $statement->bindParam(":fullname", $params['name'], \PDO::PARAM_STR);
            $statement->bindParam(":age",$params['age'], \PDO::PARAM_STR);
            $statement->bindParam(":gender", $params['gender'], \PDO::PARAM_STR);
            $statement->bindParam(":id", $args['id'], \PDO::PARAM_INT);
            $statement->execute();

            $return = $response->withJson("Operação realizada com sucesso.", 200)
                ->withHeader('Content-type', 'application/json');

        }catch (\Exception $e){

            $return = $response->withJson("Operação não realizada.", 400)
                ->withHeader('Content-type', 'application/json');
        }

        return $return;
    }


    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function destroy(Request $request, Response $response, $args )
    {
        try{

            $sql = "DELETE FROM students where id = :id";
            $statement = $this->container->db->prepare($sql);
            $statement->bindParam(':id', $args['id'], \PDO::PARAM_INT);
            $statement->execute();

            $return = $response->withJson("Operação realizada com sucesso.", 200)
                ->withHeader('Content-type', 'application/json');

        }catch (\Exception $e){

            $return = $response->withJson("Operação não realizada.", 400)
                ->withHeader('Content-type', 'application/json');
        }

        return $return;

    }



}