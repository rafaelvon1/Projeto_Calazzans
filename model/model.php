<?php
require_once __DIR__ . '/../conexao/conn.php';
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
    public function essafoidevasco($id){
        $sqlSelect = $this->connection->query("SELECT saldo from saldo_usuario where id_usuario = '$id';");
        $resultQuery = $sqlSelect->fetch(); // pega só a primeira linha
        return $resultQuery;
    }
    public function selectall(Filter $filtro) {
        try {
            // SQL com placeholder
            $sql = "SELECT * FROM tabela_saldo WHERE id_usuario = ?";

            // Prepara a query usando a conexão existente
            $stmt = $this->connection->prepare($sql);

            // Define o parâmetro
            $stmt->bindValue(1, $filtro->getId(), PDO::PARAM_INT);

            // Executa
            $stmt->execute();

            // Pega o resultado
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Retorna apenas o saldo
            return $resultado ;

        } catch (PDOException $e) {
            echo "Erro ao buscar saldo: " . $e->getMessage();
            return null;
        }
    }
    public function cadastrar_saldo(Filter $filtro) {
        try {
            // SQL com placeholder
            $sql = "INSERT INTO tabela_saldo (id_usuario, descricao_saldo, tipo_saldo, valor, data_saldo, frequencia)VALUES (?, ?, ?, ?, ?, ?)";

            // Prepara a query usando a conexão existente
            $stmt = $this->connection->prepare($sql);

            // Define o parâmetro
            
            $stmt->bindValue(1, $filtro->getId(), PDO::PARAM_INT);                 // id_usuario
            $stmt->bindValue(2, $filtro->getDescricaoSaldo(), PDO::PARAM_STR);     // descricao_saldo
            $stmt->bindValue(3, $filtro->getTipoSaldo(), PDO::PARAM_STR);          // tipo_saldo
            $stmt->bindValue(4, number_format((float)$filtro->getValorSaldo(), 2, '.', ''), PDO::PARAM_STR); // valor DECIMAL(10,2)
            $stmt->bindValue(5, $filtro->getDataSaldo(), PDO::PARAM_STR);          // data_saldo 'YYYY-MM-DD'
            $stmt->bindValue(6, $filtro->getFrequenciaSaldo(), PDO::PARAM_STR);    // frequencia

            

            // Executa
            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Erro ao buscar saldo: " . $e->getMessage();
            return null;
        }
    }
}
?>