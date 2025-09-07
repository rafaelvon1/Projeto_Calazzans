<?php       
class Filter{
    private $id;
    private $descricao;
    private $tiporendimento;
    private $valorrendimento;
   

    public function setid($id){
        $this->id = $id;

    }
    public function getid(){
        return $this->id;
    }
    public function setdescricao($descricao){
        $this->descricao= $descricao;
    }
    public function getdescricao(){
        return $this->$descricao;
    }
    public function settiporendimento($tiporendimento){
        $this->descricao= $tiporendimento;
    }
    public function  gettiporendimento(){
        return $this->$tiporendimento;
    }

}

?>