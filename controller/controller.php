<?php
require_once __DIR__ . '/../model/model.php';
class Controller{
    private $model;
    function __construct()
    {
        $this->model= new ClientModel();
    }

    public function selectall($filter){
        return $selectall= $this->model->selectall($filter);
    }

    public function cadastrar_saldo($filter){
        return $cadastrar_saldo = $this->model->cadastrar_saldo($filter);
    }



}
?>