<?php

require_once('../conexao/conn.php');
class ClientModel extends Connect{
    private $table;
    public $name;
    function __construct()
    {
        /*falo q dentro da minha classe connect iniciar o construct */
        parent::__construct();
        $this->table ='clients';
    }
    public function getAll()
    {
        $sqlSelect = $this->connection->query("SELECT * from clients");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    public function getid()
    {
        $id = $_GET['id'];
        $sqlSelect = $this->connection->query("SELECT * from clients where id = $id");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    public function Change($name,$email,$phone){
        $id = $_GET['id'];
        $sqlSelect = $this->connection->query("UPDATE clients set name = '$name', email = '$email',phone = '$phone' where id = '$id'");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    public function Inserir($descricaoRendimento,$tipoRendimento,$valorRendimento,$frequenciaRendimento){
        $sqlSelect = $this->connection->query("INSERT into saldo_usuario values (null,'$descricaoRendimento','$tipoRendimento','$valorRendimento','$frequenciaRendimento')");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    public function Delete(){
        $id = $_GET['id'];
        $sqlSelect = $this->connection->query("DELETE from clients where id = '$id';");
        $resultQuery = $sqlSelect->fetchAll();
        return $resultQuery;
    }
    public function teste_saldo($id){
        $sqlSelect = $this->connection->query("SELECT saldo from saldo_usuario where id_usuario = '$id';");
        $resultQuery = $sqlSelect->fetch(); // pega só a primeira linha
        return $resultQuery;
    }
}
?>