<?php

require_once('./conexao/conn.php');
class ClientModel extends Connect{
    private $table;
    public $name;
    function __construct()
    {
        /*falo q dentro da minha classe connect iniciar o construct */
        parent::__construct();
        $this->table ='clients';
    }
    function getAll()
    {
        $sqlSelect = $this->connection->query("SELECT * from clients");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    function getid()
    {
        $id = $_GET['id'];
        $sqlSelect = $this->connection->query("SELECT * from clients where id = $id");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    function Change($name,$email,$phone){
        $id = $_GET['id'];
        $sqlSelect = $this->connection->query("UPDATE clients set name = '$name', email = '$email',phone = '$phone' where id = '$id'");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    function Inserir($descricaoRendimento,$tipoRendimento,$valorRendimento,$frequenciaRendimento){
        $sqlSelect = $this->connection->query("INSERT into saldo_usuario values (null,'$descricaoRendimento','$tipoRendimento','$valorRendimento','$frequenciaRendimento')");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    function Delete(){
        $id = $_GET['id'];
        $sqlSelect = $this->connection->query("DELETE from clients where id = '$id';");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
}
?>