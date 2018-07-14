<?php
//
////namespace  App\Config;
//
////use PDO;
//
//class Conexao {
//
//    /*
//     * Atributo estático para instância do PDO
//     */
////    private static $pdo;
//
//
//
//    private function conexao( $servername, $dbname, $username, $password ){
//
////        try {
////            $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password,
////                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
////
////        }
////        catch(PDOException $e){
////            throw new Exception($e->getMessage(), 1);
////        }
////
////        return $pdo;
//    }
//
//    /*
//     * Método estático para retornar uma conexão válida
//     * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão
//     */
//    public static function getInstance() {
//
//
//
////        $pdo = self::conexao( HOST, DBNAME, USER, PASSWORD );
////
////        $sql = "SELECT * FROM 'livro'";
////            $sth = $pdo->prepare($sql);
////
////            $sth->execute();
////
////            $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
////
////
////        var_dump( $results );
////
////
////
////
////        if (!isset(self::$pdo)) {
////
////            try {
//
//
//
//
//
//
////                $pdo = new \PDO("mysql:host=localhost;dbname=u880525892_fiap;charset=utf8", "root", "vagrant",
////                    array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
//
//
//
//
////                $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8", USER, PASSWORD,
////                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
//
////                die( '-----------' );
////
////            } catch (\PDOException $e) {
////
////                print "Erro: " . $e->getMessage();
////            }
////        }
////        return self::$pdo;
//    }
//}
