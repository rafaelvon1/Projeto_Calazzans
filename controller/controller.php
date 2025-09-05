<?php

include('../model/model.php');
class Controller{
    private $model;
    function __construct()
    {
        $this->model= new ClientModel();
    }
    public function getAll()
    {
        $selectAll= $this->model->getAll();
        require_once('./views/index.php');
    }
    public function Profile()
    {      
        $selectid= $this->model->getId();
        if ($_GET['action'] == 'viewProfile') {
            require_once('./views/perfil.php');
        }
        else {
            require_once('./views/alterar.php');
        }
        
        //ola mundo
    }
    public function Update($name,$email,$phone){
        $change= $this->model->Change($name,$email,$phone);
        $selectid= $this->model->getId();
        require_once('./views/perfil.php');
    }
    public function Inserir($descricaoRendimento,$tipoRendimento,$valorRendimento,$frequenciaRendimento){
        $valorRendimento = (float)$valorRendimento;

        $insert = $this->model->Inserir($descricaoRendimento,$tipoRendimento,$valorRendimento,$frequenciaRendimento);
        header('location:./index.php');
    }
    public function Delete(){
        $delete= $this->model->Delete();
        header('location:./index.php');
    }
    public function teste($id){
        return $delete= $this->model->teste_saldo($id);
    }

}
?>