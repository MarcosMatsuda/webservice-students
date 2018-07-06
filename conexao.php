<?php

function conexao( $servername, $dbname, $username, $password ){
    
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    }
    catch(PDOException $e){
        //throw new Exception("Erro na conexão", 1);
        throw new Exception($e->getMessage(), 1);
    }
    
    return $pdo;
}


?>