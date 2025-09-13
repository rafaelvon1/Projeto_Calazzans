<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Para pegar id_usuario da sessão

class Index {

    private $controller;
    private $filter;

    public function __construct() {
        include_once __DIR__ . '/controller/controller.php';
        include_once __DIR__ . '/controller/filter.php';

        $this->controller = new Controller();
        $this->filter = new Filter();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePost();
        }
    }

    private function handlePost() {
        if (!isset($_POST['form_type'])) {
            echo "Erro: 'form_type' não foi enviado.";
            return;
        }

        switch ($_POST['form_type']) {
            case 'add_saldo':
                $this->addSaldo();
                break;

            case 'add_expense':
                $this->addExpense();
                break;

            default:
                echo "Tipo de formulário desconhecido.";
                break;
        }
    }

    private function addSaldo() {
        $id_usuario = $_SESSION['id_usuario'] ?? 1; // Substitua 1 pelo ID do usuário real

        if ($id_usuario == 0) {
            echo "Erro: usuário não logado.";
            return;
        }

        // Preenchendo o filtro com os dados do POST
        $this->filter->setid($id_usuario);
        $this->filter->setDescricaoSaldo($_POST['descricao_rendimento'] ?? '');
        $this->filter->setTipoSaldo($_POST['tipo_rendimento'] ?? '');
        $this->filter->setValorSaldo($_POST['valor_rendimento'] ?? 0);
        $this->filter->setDataSaldo($_POST['data_rendimento'] ?? '');
        $this->filter->setFrequenciaSaldo($_POST['frequencia_rendimento'] ?? '');

        // Chamando o controller
        $result = $this->controller->cadastrar_saldo($this->filter);

        if ($result) {
            header("Location: views/calazzans_page.php");

        } else {
            echo "<p style='color:red;'>Erro ao cadastrar saldo.</p>";
        }
    }

    private function addExpense() {
        $descricaoDespesa = $_POST['descricao_despesa'] ?? 'Não informado';
        $valorDespesa = $_POST['valor_despesa'] ?? 0;
        $statusDespesa = $_POST['status_despesa'] ?? 'pago';
        $tagDespesa = $_POST['tag_despesa'] ?? 'outros';
        $frequenciaDespesa = $_POST['frequencia_despesa'] ?? 'unica';
        $pagamentoDespesa = $_POST['pagamento_despesa'] ?? 'Não informado';
        $parcelasDespesa = $_POST['parcelas_despesa'] ?? 1;

        echo "<h2>Processando Despesa...</h2>";
        echo "Descrição: " . htmlspecialchars($descricaoDespesa) . "<br>";
        echo "Valor: R$ " . number_format($valorDespesa, 2, ',', '.') . "<br>";
        echo "Status: " . htmlspecialchars($statusDespesa) . "<br>";
        echo "Tag: " . htmlspecialchars($tagDespesa) . "<br>";
        echo "Frequência: " . htmlspecialchars($frequenciaDespesa) . "<br>";
        echo "Forma de Pagamento: " . htmlspecialchars($pagamentoDespesa) . "<br>";
        echo "Parcelas: " . htmlspecialchars($parcelasDespesa) . "<br>";
    }

    public function selectAll($id_usuario) {
        $this->filter->setid($id_usuario);
        return $this->controller->selectall($this->filter);
    }
}

// Inicializa a classe
new Index();
?>
