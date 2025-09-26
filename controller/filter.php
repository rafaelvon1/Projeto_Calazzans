<?php       
class Filter {
    private $id;
    private $descricao_saldo;
    private $tipo_saldo;
    private $valor_saldo;
    private $data_saldo;
    private $frequencia_saldo;

    // ID
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    // Descrição Saldo
    public function setDescricaoSaldo($descricao_saldo) {
        $this->descricao_saldo = $descricao_saldo;
    }
    public function getDescricaoSaldo() {
        return $this->descricao_saldo;
    }

    // Tipo Saldo
    public function setTipoSaldo($tipo_saldo) {
        $this->tipo_saldo = $tipo_saldo;
    }
    public function getTipoSaldo() {
        return $this->tipo_saldo;
    }

    // Valor Saldo
    public function setValorSaldo($valor_saldo) {
        $this->valor_saldo = $valor_saldo;
    }
    public function getValorSaldo() {
        return $this->valor_saldo;
    }

    // Data Saldo
    public function setDataSaldo($data_saldo) {
        $this->data_saldo = $data_saldo;
    }
    public function getDataSaldo() {
        return $this->data_saldo;
    }

    // Frequência Saldo
    public function setFrequenciaSaldo($frequencia_saldo) {
        $this->frequencia_saldo = $frequencia_saldo;
    }
    public function getFrequenciaSaldo() {
        return $this->frequencia_saldo;
    }
}
?>
