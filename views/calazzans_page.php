<?php
include_once __DIR__ . '/../index.php';

$index = new index();
$id_usuario = 1;

$result = $index->selectall($id_usuario);

// --- INÍCIO DO BACKEND (Simulação de Dados) ---

// Calcula o primeiro e o último dia do mês atual para o modal de Rendimento
$primeiroDiaMes = date('Y-m-01');
$ultimoDiaMes = date('Y-m-t');

// Adicionado: Calcula o intervalo de 1 ano para o modal de Despesa
$dataMinDespesa = date('Y-m-d', strtotime('-1 year'));
$dataMaxDespesa = date('Y-m-d', strtotime('+1 year'));


// Função para formatar números como moeda brasileira (BRL)
function formatar_moeda($valor)
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

// Lógica para processar os dados do formulário quando enviados (POST)
// (Esta parte ficaria no seu arquivo index.php, aqui é apenas uma simulação)

// --- DADOS DINÂMICOS (Valores zerados conforme solicitado) ---

// Valores do retângulo superior
$saldoMes = $result[1]["valor"];
$despesasMes = 0.00;

// Card: Saldo Atual
$saldoAtual = $result[0]["valor"];
$proximosRecebimentos = [
    ['descricao' => 'Salário (1ª Parcela)', 'data' => '05/07/2025'],
    ['descricao' => 'Bico (Projeto Y)', 'data' => '10/07/2025'],
    ['descricao' => 'Salário (2ª Parcela)', 'data' => '20/07/2025'],
];

// Card: Despesas (a lógica de "Ver mais" será aplicada no loop)
$totalDespesasCard = 0.00; // Soma de todas as despesas abaixo

#esse campo tem que ter um limite
$listaDespesas = [
    ['item' => 'Supermercado', 'valor' => 0.00],
];
$listaDespesas[] = ['item' => 'Transporte', 'valor' => 15.50];

// Card: Meta de Gastos
$gastoAtualMeta = $despesasMes;
$metaGastos = 0.00;
$percentualMeta = ($metaGastos > 0) ? ($gastoAtualMeta / $metaGastos) * 100 : 0;

// Card: Histórico de Gastos
$historicoGastos = [
    'Maio' => 0.00,
    'Abril' => 0.00,
    'Março' => 0.00,
    'Fevereiro' => 0.00,
];

// Gráfico de Pizza: Despesas por Categoria
$despesasCategoriaLabels = ['Alimentação', 'Transporte', 'Moradia', 'Lazer', 'Serviços', 'Outros'];
$despesasCategoriaValores = [0, 0, 0, 0, 0, 0];

// Gráfico de Barras: Vendas Mensais
$vendasMensaisLabels = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'];
$vendasMensaisValores = [0, 0, 0, 0, 0, 0];

// --- FIM DO BACKEND ---
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calazzans</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos gerais do corpo da página */
        body {
            margin: 0;
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f5f8fa;
            color: #003366;
        }

        /* Cabeçalho superior */
        .topo {
            background-color: #00cc66;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .topo h1 {
            margin: 0 auto;
            font-size: 32px;
            font-weight: 700;
        }

        /* Retângulo principal de informações */
        .retangulo {
            background-color: #ffffff;
            margin: 40px auto 30px;
            width: 90%;
            max-width: 1600px;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        .texto-retangulo {
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex: 1;
            min-width: 250px;
        }

        .intro-text {
            font-size: 20px;
            font-weight: 600;
        }

        .info-linha {
            display: flex;
            gap: 60px;
            flex-wrap: wrap;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            font-size: 18px;
        }

        .saldo {
            color: #009944;
            font-size: 26px;
            margin-top: 6px;
            font-weight: bold;
        }

        .despesas {
            color: #cc0000;
            font-size: 26px;
            margin-top: 6px;
            font-weight: bold;
        }

        .divisoria {
            width: 1px;
            height: 130px;
            background-color: rgba(0, 51, 102, 0.15);
            margin: 0 30px;
            align-self: center;
        }

        .botoes {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .botao {
            background-color: #00cc66;
            border: none;
            color: white;
            font-size: 28px;
            width: 55px;
            height: 55px;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .botao:hover {
            background-color: #00b35a;
            transform: scale(1.05);
        }

        /* Grade de quadrados de informações */
        .grade-quadrados {
            width: 90%;
            max-width: 1600px;
            margin: 0 auto 60px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 25px;
        }

        .quadrado {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
            padding: 30px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 350px;
            cursor: grab;
        }

        .quadrado.dragging {
            opacity: 0.5;
            cursor: grabbing;
            border: 2px dashed #00cc66;
            box-shadow: none;
            transform: scale(0.98);
        }

        .quadrado:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .titulo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .quadrado .titulo {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .quadrado .valor {
            font-size: 26px;
            font-weight: bold;
            color: #009944;
        }

        .quadrado.despesa-lista {
            align-items: flex-start;
            text-align: left;
        }

        .quadrado.despesa-lista .titulo,
        .quadrado.despesa-lista .valor {
            align-self: center;
            text-align: center;
        }

        .quadrado.despesa-lista .valor {
            color: #cc0000;
        }

        .lista-itens {
            margin-top: 20px;
            padding-left: 20px;
            list-style-type: disc;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
            width: 100%;
        }

        .oculto {
            display: none;
        }

        .ver-mais-btn {
            margin-top: auto;
            padding-top: 10px;
            font-size: 14px;
            color: #0077cc;
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: underline;
            align-self: center;
        }

        /* Estilos para próximos recebimentos */
        .proximos-recebimentos {
            margin-top: 25px;
            text-align: left;
            font-size: 14px;
            width: 100%;
            border-top: 1px solid #f0f0f0;
            padding-top: 15px;
        }

        .proximos-recebimentos-titulo {
            font-weight: 600;
            color: #003366;
            margin-bottom: 8px;
            text-align: center;
        }

        .lista-datas {
            list-style-type: none;
            padding: 0;
            margin: 0;
            color: #333;
        }

        .lista-datas li {
            padding: 6px 0;
            border-bottom: 1px solid #f5f5f5;
            display: flex;
            justify-content: space-between;
        }

        .lista-datas li:last-child {
            border-bottom: none;
        }

        /* Estilos para a Meta de Gastos */
        .meta-info {
            font-size: 18px;
            margin: 15px 0;
            color: #555;
        }

        .gasto-atual {
            font-weight: 600;
            color: #cc0000;
        }

        .meta-total {
            font-weight: 600;
            color: #009944;
        }

        .progress-bar-container {
            width: 90%;
            height: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .progress-bar-fill {
            height: 100%;
            background-color: #00cc66;
            border-radius: 10px;
            transition: width 0.5s ease-in-out;
        }

        .meta-status {
            font-size: 14px;
            font-weight: 500;
        }

        .botao-meta {
            background-color: #28a745;
            color: white;
            border: none;
            font-size: 18px;
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            line-height: 1;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .botao-meta:hover {
            background-color: #218838;
            transform: scale(1.1);
        }

        /* Estilos para o Histórico de Gastos */
        .lista-historico {
            list-style-type: none;
            padding: 0;
            margin: 20px 0 0 0;
            width: 100%;
            text-align: left;
        }

        .lista-historico li {
            display: flex;
            justify-content: space-between;
            padding: 10px 10px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 15px;
        }

        .lista-historico li:last-child {
            border-bottom: none;
        }

        .lista-historico li span:last-child {
            font-weight: 600;
            color: #cc0000;
        }


        /* Container do gráfico */
        .grafico-container {
            background: #fff;
            border: 1px solid #00cc66;
            border-radius: 12px;
            padding: 20px;
            margin: 20px auto 60px;
            max-width: 1600px;
            width: 90%;
            box-shadow: 0 4px 12px rgba(0, 204, 102, 0.2);
            text-align: center;
        }

        .grafico-container h2 {
            margin: 0 0 15px 0;
            color: #009944;
            font-weight: 700;
            font-size: 22px;
        }

        /* Estilos do Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-conteudo {
            background-color: #fff;
            margin: 5% auto;
            padding: 25px 40px;
            border: none;
            width: 90%;
            max-width: 450px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            text-align: left;
            position: relative;
        }

        .modal-conteudo h2 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #00cc66;
            text-align: center;
        }

        .modal-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }

        .modal-input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        .modal-grupo-inline {
            display: flex;
            gap: 20px;
        }

        .modal-grupo-inline>div {
            flex: 1;
        }

        .modal-confirmar {
            background-color: #00cc66;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .modal-confirmar:hover {
            background-color: #00b35a;
        }

        .fechar {
            position: absolute;
            top: 12px;
            right: 18px;
            font-size: 28px;
            font-weight: bold;
            color: #999;
            cursor: pointer;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .retangulo {
                flex-direction: column;
                gap: 20px;
            }

            .divisoria {
                width: 80%;
                height: 1px;
                margin: 20px 0;
            }

            .botoes {
                flex-direction: row;
            }

            .modal-conteudo {
                margin: 10% auto;
            }
        }
    </style>
</head>

<body>

    <div class="topo">
        <div class="icone"></div>
        <h1>Calazzans</h1>
        <div class="icone"></div>
    </div>

    <div class="retangulo">
        <div class="texto-retangulo">
            <div class="intro-text">Vamos gerenciar seu dinheiro</div>
            <div class="info-linha">
                <div class="info-item">
                    <div>Saldo do mês:</div>
                    <span class="saldo"><?= formatar_moeda($saldoMes) ?></span>
                </div>
                <div class="info-item">
                    <div>Despesas do mês:</div>
                    <span class="despesas"><?= formatar_moeda($despesasMes) ?></span>
                </div>
            </div>
        </div>

        <div class="divisoria"></div>

        <div class="botoes">
            <button class="botao" onclick="abrirModal('adicionar')">+</button>
            <button class="botao" onclick="abrirModal('remover')">−</button>
        </div>
    </div>

    <div class="grade-quadrados">
        <div class="quadrado" draggable="true">
            <div class="titulo">Saldo atual</div>
            <div class="valor"><?= formatar_moeda($saldoAtual) ?></div>
            <div class="proximos-recebimentos">
                <div class="proximos-recebimentos-titulo">Próximos recebimentos</div>
                <ul class="lista-datas">
                    <?php foreach ($proximosRecebimentos as $recebimento) : ?>
                        <li><span><?= htmlspecialchars($recebimento['descricao']) ?></span> <span><?= htmlspecialchars($recebimento['data']) ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="quadrado despesa-lista" draggable="true">
            <div class="titulo">Despesas</div>
            <div class="valor"><?= formatar_moeda($totalDespesasCard) ?></div>
            <ul class="lista-itens">
                <?php $i = 0;
                foreach ($listaDespesas as $despesa) : ?>
                    <li class="<?= ($i++ >= 5) ? 'oculto' : '' ?>">
                        <?= htmlspecialchars($despesa['item']) ?> - <?= formatar_moeda($despesa['valor']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if (count($listaDespesas) > 5) : ?>
                <button class="ver-mais-btn" onclick="toggleDespesas(this)">Ver mais</button>
            <?php endif; ?>
        </div>

        <div class="quadrado" draggable="true">
            <div class="titulo">Despesas por Categoria</div>
            <canvas id="graficoDespesasPizza" style="margin-top: 15px; max-height: 250px;"></canvas>
        </div>

        <div class="quadrado" draggable="true">
            <div class="titulo-container">
                <div class="titulo">Meta de Gastos (Mês)</div>
                <button class="botao-meta" onclick="abrirModal('meta')" title="Definir Meta">🎯</button>
            </div>
            <div class="meta-info">
                <span class="gasto-atual"><?= formatar_moeda($gastoAtualMeta) ?></span> / <span class="meta-total"><?= formatar_moeda($metaGastos) ?></span>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: <?= number_format($percentualMeta, 2) ?>%;"></div>
            </div>
            <div class="meta-status">
                <?php
                if ($percentualMeta > 100) {
                    echo 'Atenção! Você ultrapassou a meta.';
                } elseif ($percentualMeta > 85) {
                    echo 'Cuidado, você está próximo de atingir a meta.';
                } else {
                    echo 'Você está dentro da meta!';
                }
                ?>
            </div>
        </div>

        <div class="quadrado" draggable="true">
            <div class="titulo">Histórico de Gastos</div>
            <ul class="lista-historico">
                <?php foreach ($historicoGastos as $mes => $valor) : ?>
                    <li><span><?= htmlspecialchars($mes) ?>:</span> <span><?= formatar_moeda($valor) ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="grafico-container">
        <h2>Vendas Mensais</h2>
        <canvas id="graficoVendas"></canvas>
    </div>

    <div id="modal" class="modal">
        <div id="modal-adicionar" class="modal-conteudo" style="display: none;">
            <form method="POST" action="../index.php" novalidate>
                <input type="hidden" name="form_type" value="add_saldo">
                <span class="fechar" onclick="fecharModal()">&times;</span>
                <h2>Adicionar Rendimento</h2>
                <label for="descricaoRendimento" class="modal-label">Descrição</label>
                <input id="descricaoRendimento" name="descricao_rendimento" type="text" placeholder="Ex: Salário da empresa X" class="modal-input" required />
                <div class="modal-grupo-inline">
                    <div>
                        <label for="tipoRendimento" class="modal-label">Tipo de Rendimento</label>
                        <select id="tipoRendimento" name="tipo_rendimento" class="modal-input" required>
                            <option value="salario">Salário</option>
                            <option value="bico">Bico</option>
                            <option value="unico">Renda Única</option>
                        </select>
                    </div>
                    <div>
                        <label for="valorRendimento" class="modal-label">Valor (R$)</label>
                        <input id="valorRendimento" name="valor_rendimento" type="number" step="0.01" placeholder="0.00" class="modal-input" required />
                    </div>
                </div>

                <label for="dataRendimento" class="modal-label">Data do Rendimento</label>
                <input id="dataRendimento" type="date" class="modal-input" required min="<?= $primeiroDiaMes ?>" max="<?= $ultimoDiaMes ?>" />
                <input type="hidden" id="dataRendimentoFormatada" name="data_rendimento" />

                <label for="frequencia" class="modal-label">Frequência</label>
                <select id="frequencia" name="frequencia_rendimento" class="modal-input" required>
                    <option value="unica">Única</option>
                    <option value="mensal">Mensal</option>
                    <option value="quinzenal">Quinzena</option>
                </select>
                <button type="submit" class="modal-confirmar">Confirmar</button>
            </form>
        </div>

        <div id="modal-remover" class="modal-conteudo" style="display: none;">
            <form method="POST" action="../index.php" novalidate>
                <input type="hidden" name="form_type" value="add_expense">
                <span class="fechar" onclick="fecharModal()">&times;</span>
                <h2 style="color: #cc0000;">Adicionar Despesa</h2>
                <label for="descricaoDespesa" class="modal-label">Descrição da Compra</label>
                <input id="descricaoDespesa" name="descricao_despesa" type="text" placeholder="Ex: Jantar com amigos" class="modal-input" required />

                <label for="dataDespesa" class="modal-label">Data da Despesa</label>
                <input id="dataDespesa" type="date" class="modal-input" required min="<?= $dataMinDespesa ?>" max="<?= $dataMaxDespesa ?>" />
                <input type="hidden" id="dataDespesaFormatada" name="data_despesa" />

                <div class="modal-grupo-inline">
                    <div>
                        <label for="valorDespesa" class="modal-label">Valor (R$)</label>
                        <input id="valorDespesa" name="valor_despesa" type="number" step="0.01" placeholder="0.00" class="modal-input" required />
                    </div>
                    <div>
                        <label for="statusDespesa" class="modal-label">Status</label>
                        <select id="statusDespesa" name="status_despesa" class="modal-input" required>
                            <option value="pago">Pago</option>
                            <option value="pendente">Pendente</option>
                        </select>
                    </div>
                </div>
                <label for="tagsDespesa" class="modal-label">Tag</label>
                <select id="tagsDespesa" name="tag_despesa" class="modal-input" required>
                    <option value="alimentacao">Alimentação</option>
                    <option value="guardar">Guardar</option>
                    <option value="acessorio">Acessório</option>
                    <option value="jogo">Jogo</option>
                    <option value="academia">Academia</option>
                    <option value="servico">Serviço</option>
                </select>
                <label for="frequenciaDespesa" class="modal-label">Frequência</label>
                <select id="frequenciaDespesa" name="frequencia_despesa" class="modal-input" required>
                    <option value="unica">Única</option>
                    <option value="mensal">Mensal</option>
                    <option value="quinzenal">Quinzena</option>
                </select>
                <div class="modal-grupo-inline">
                    <div>
                        <label for="pagamentoDespesa" class="modal-label">Forma de Pagamento</label>
                        <select id="pagamentoDespesa" name="pagamento_despesa" class="modal-input" required>
                            <option value="pix">Pix</option>
                            <option value="boleto">Boleto</option>
                            <option value="cartao_credito">Cartão de Crédito</option>
                        </select>
                    </div>
                    <div>
                        <label for="parcelasDespesa" class="modal-label">Parcelas</label>
                        <input id="parcelasDespesa" name="parcelas_despesa" type="number" placeholder="1" value="1" min="1" class="modal-input" required />
                    </div>
                </div>
                <button type="submit" class="modal-confirmar" style="background-color: #cc0000;">Confirmar</button>
            </form>
        </div>

        <div id="modal-meta" class="modal-conteudo" style="display: none;">
            <form method="POST" action="../index.php" novalidate>
                <input type="hidden" name="form_type" value="set_meta">
                <span class="fechar" onclick="fecharModal()">&times;</span>
                <h2>Definir Meta de Gastos</h2>
                <label for="valorMeta" class="modal-label">Valor da Meta (R$)</label>
                <input id="valorMeta" name="valor_meta" type="number" step="0.01" placeholder="2000.00" class="modal-input" required />
                <button type="submit" class="modal-confirmar">Salvar Meta</button>
            </form>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Função para mostrar/ocultar despesas
            window.toggleDespesas = function(botao) {
                const container = botao.closest('.despesa-lista');
                const itensOcultos = container.querySelectorAll('.oculto');
                const ocultosVisiveis = itensOcultos.length > 0 && itensOcultos[0].style.display === 'list-item';

                if (ocultosVisiveis) {
                    itensOcultos.forEach(item => item.style.display = 'none');
                    botao.textContent = 'Ver mais';
                } else {
                    itensOcultos.forEach(item => item.style.display = 'list-item');
                    botao.textContent = 'Ver menos';
                }
            }

            // Gráfico de Barras - Vendas Mensais
            const ctx = document.getElementById('graficoVendas').getContext('2d');
            const graficoVendas = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($vendasMensaisLabels) ?>,
                    datasets: [{
                        label: 'Vendas',
                        data: <?= json_encode($vendasMensaisValores) ?>,
                        backgroundColor: 'rgba(0, 204, 102, 0.7)',
                        borderColor: 'rgba(0, 204, 102, 1)',
                        borderWidth: 1,
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#003366',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico de Pizza - Despesas por Categoria
            const ctxPizza = document.getElementById('graficoDespesasPizza').getContext('2d');
            const graficoDespesasPizza = new Chart(ctxPizza, {
                type: 'doughnut',
                data: {
                    labels: <?= json_encode($despesasCategoriaLabels) ?>,
                    datasets: [{
                        label: 'Despesas por Categoria',
                        data: <?= json_encode($despesasCategoriaValores) ?>,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                boxWidth: 12,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });


            // --- Lógica do Modal ---
            const modal = document.getElementById('modal');
            const modalAdicionar = document.getElementById('modal-adicionar');
            const modalRemover = document.getElementById('modal-remover');
            const modalMeta = document.getElementById('modal-meta');

            window.abrirModal = function(tipo) {
                fecharModal();
                if (tipo === 'adicionar') {
                    modalAdicionar.style.display = 'block';
                } else if (tipo === 'remover') {
                    modalRemover.style.display = 'block';
                } else if (tipo === 'meta') {
                    modalMeta.style.display = 'block';
                }
                modal.style.display = 'block';
            }

            window.fecharModal = function() {
                modal.style.display = 'none';
                modalAdicionar.style.display = 'none';
                modalRemover.style.display = 'none';
                modalMeta.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target === modal) {
                    fecharModal();
                }
            }

            // --- INÍCIO: Lógica de Validação dos Modais ---
            const formAdicionar = document.querySelector('#modal-adicionar form');
            const formRemover = document.querySelector('#modal-remover form');
            const formMeta = document.querySelector('#modal-meta form');

            formAdicionar.addEventListener('submit', function(event) {
                event.preventDefault();

                const descricao = document.getElementById('descricaoRendimento').value.trim();
                const valor = document.getElementById('valorRendimento').value;
                const data = document.getElementById('dataRendimento').value;

                if (descricao === '') {
                    alert('O campo "Descrição" é obrigatório.');
                    return;
                }
                if (!isNaN(descricao) && isFinite(descricao)) {
                    alert('A descrição não pode ser apenas um número. Por favor, seja mais descritivo.');
                    return;
                }

                if (valor === '' || isNaN(parseFloat(valor)) || parseFloat(valor) <= 0) {
                    alert('Por favor, insira um valor de rendimento válido e positivo.');
                    return;
                }

                if (data === '') {
                    alert('Por favor, selecione uma data para o rendimento.');
                    return;
                }

                const dataISO = document.getElementById('dataRendimento').value;
                const partesData = dataISO.split('-');
                const dataFormatada = `${partesData[2]}/${partesData[1]}/${partesData[0]}`;
                document.getElementById('dataRendimentoFormatada').value = dataFormatada;

                this.submit();
            });

            formRemover.addEventListener('submit', function(event) {
                event.preventDefault();

                const descricao = document.getElementById('descricaoDespesa').value.trim();
                const data = document.getElementById('dataDespesa').value;
                const valor = document.getElementById('valorDespesa').value;
                const parcelas = document.getElementById('parcelasDespesa').value;

                if (descricao === '') {
                    alert('O campo "Descrição da Compra" é obrigatório.');
                    return;
                }

                if (data === '') {
                    alert('Por favor, selecione uma data para a despesa.');
                    return;
                }

                if (valor === '' || isNaN(parseFloat(valor)) || parseFloat(valor) <= 0) {
                    alert('Por favor, insira um valor de despesa válido e positivo.');
                    return;
                }

                if (parcelas === '' || isNaN(parseInt(parcelas)) || parseInt(parcelas) < 1) {
                    alert('O número de parcelas deve ser um número inteiro igual ou maior que 1.');
                    return;
                }

                const dataISO = document.getElementById('dataDespesa').value;
                const partesData = dataISO.split('-');
                const dataFormatada = `${partesData[2]}/${partesData[1]}/${partesData[0]}`;
                document.getElementById('dataDespesaFormatada').value = dataFormatada;

                this.submit();
            });

            formMeta.addEventListener('submit', function(event) {
                event.preventDefault();
                const valor = document.getElementById('valorMeta').value;

                if (valor === '' || isNaN(parseFloat(valor)) || parseFloat(valor) <= 0) {
                    alert('Por favor, insira um valor de meta válido e positivo.');
                    return;
                }
                this.submit();
            });

            // --- FIM: Lógica de Validação ---


            // --- Lógica de Arrastar e Soltar ---
            const draggables = document.querySelectorAll('.quadrado[draggable="true"]');
            const container = document.querySelector('.grade-quadrados');

            draggables.forEach(draggable => {
                draggable.addEventListener('dragstart', () => {
                    draggable.classList.add('dragging');
                });

                draggable.addEventListener('dragend', () => {
                    draggable.classList.remove('dragging');
                });
            });

            container.addEventListener('dragover', e => {
                e.preventDefault();
                const afterElement = getDragAfterElement(container, e.clientX);
                const dragging = document.querySelector('.dragging');
                if (dragging) {
                    if (afterElement == null) {
                        container.appendChild(dragging);
                    } else {
                        container.insertBefore(dragging, afterElement);
                    }
                }
            });

            function getDragAfterElement(container, x) {
                const draggableElements = [...container.querySelectorAll('.quadrado:not(.dragging)')];

                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = x - box.left - box.width / 2;
                    if (offset < 0 && offset > closest.offset) {
                        return {
                            offset: offset,
                            element: child
                        };
                    } else {
                        return closest;
                    }
                }, {
                    offset: Number.NEGATIVE_INFINITY
                }).element;
            }
        });
    </script>

</body>

</html>