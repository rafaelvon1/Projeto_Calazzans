<?php
class index{


    public function selectall($id_usuario){
        include_once("controller/controller.php");
        $controller= new Controller();
        return $controller->teste($id_usuario);
    }

    function __construct()
    {   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include_once("controller/controller.php");
            $controller= new Controller();

            // Dica de Mestre: Use print_r($_POST) para ver TUDO que o formulário enviou.
            // É a melhor forma de depurar! Envolvemos em <pre> para formatar a saída.
            echo "<pre>";
            echo "Dados recebidos via POST:\n";
            print_r($_POST);
            echo "</pre>";

        // Verifica qual formulário foi enviado através do campo oculto 'form_type'
        if (isset($_POST['form_type'])) {

            // --- LÓGICA PARA O FORMULÁRIO DE RENDIMENTO ---
            if ($_POST['form_type'] === 'add_income') {

                // Captura de TODOS os dados do formulário de rendimento
                $descricaoRendimento = $_POST['descricao_rendimento'] ?? 'Não informado';
                $tipoRendimento = $_POST['tipo_rendimento'] ?? 'Não informado';
                $valorRendimento = $_POST['valor_rendimento'] ?? 0;
                $frequenciaRendimento = $_POST['frequencia_rendimento'] ?? 'unica';


                $controller->Inserir($descricaoRendimento, $tipoRendimento, $valorRendimento, $frequenciaRendimento);

                // Exibindo os valores capturados para confirmação
                
                
                // !! AQUI VOCÊ COLOCA A LÓGICA PARA SALVAR NO BANCO DE DADOS !!
                // Exemplo: salvar_rendimento_no_db($descricaoRendimento, $tipoRendimento, $valorRendimento, $frequenciaRendimento);
                
            // --- LÓGICA PARA O FORMULÁRIO DE DESPESA ---
            } elseif ($_POST['form_type'] === 'add_expense') {
                
                echo "<h2>Processando Despesa...</h2>";

                // Captura de TODOS os dados do formulário de despesa
                $descricaoDespesa = $_POST['descricao_despesa'] ?? 'Não informado';
                $valorDespesa = $_POST['valor_despesa'] ?? 0;
                $statusDespesa = $_POST['status_despesa'] ?? 'pago';
                $tagDespesa = $_POST['tag_despesa'] ?? 'outros';
                $frequenciaDespesa = $_POST['frequencia_despesa'] ?? 'unica';
                $pagamentoDespesa = $_POST['pagamento_despesa'] ?? 'Não informado';
                $parcelasDespesa = $_POST['parcelas_despesa'] ?? 1;
                
                // Exibindo os valores capturados para confirmação
                echo "Descrição: " . htmlspecialchars($descricaoDespesa) . "<br>";
                echo "Valor: R$ " . number_format($valorDespesa, 2, ',', '.') . "<br>";
                echo "Status: " . htmlspecialchars($statusDespesa) . "<br>";
                echo "Tag: " . htmlspecialchars($tagDespesa) . "<br>";
                echo "Frequência: " . htmlspecialchars($frequenciaDespesa) . "<br>";
                echo "Forma de Pagamento: " . htmlspecialchars($pagamentoDespesa) . "<br>";
                echo "Parcelas: " . htmlspecialchars($parcelasDespesa) . "<br>";

                // !! AQUI VOCÊ COLOCA A LÓGICA PARA SALVAR NO BANCO DE DADOS !!
                // Exemplo: salvar_despesa_no_db($descricaoDespesa, $valorDespesa, ...todos os outros campos...);

            } else {
                echo "Tipo de formulário desconhecido.";
            }

        } else {
            echo "Erro: 'form_type' não foi enviado.";
        }

        // Após processar e salvar no banco, o ideal é redirecionar para evitar reenvio
        // Exemplo:
        // header("Location: views/calazzans_page.php?status=success");
        // exit();

    } else {
        // Se a requisição NÃO for POST, redireciona para a página principal.
        // Isso impede que acessem este script diretamente pela URL.
        #header("Location: views/calazzans_page.php");
        
        // Sempre use exit() após um redirecionamento de header.
    }
    }
}
?>