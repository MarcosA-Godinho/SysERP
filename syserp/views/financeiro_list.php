<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financeiro - Aexon</title>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f8fafc; }
        
        /* Navbar Corporativa Aexon */
        .navbar { background-color: #1e293b; color: white; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 24px; font-weight: bold; letter-spacing: 1px; }
        .navbar-brand span { font-size: 12px; color: #94a3b8; font-weight: normal; text-transform: uppercase; letter-spacing: 2px; }
        .user-info { display: flex; align-items: center; gap: 20px; font-size: 14px; }
        .btn-nav-voltar { color: #94a3b8; text-decoration: none; font-weight: bold; transition: color 0.2s; }
        .btn-nav-voltar:hover { color: white; }
        .logout-btn { background: #ef4444; color: white; padding: 8px 16px; text-decoration: none; border-radius: 6px; font-weight: bold; transition: background 0.2s; }
        .logout-btn:hover { background: #dc2626; }

        /* Container Principal */
        .container { padding: 40px; max-width: 1100px; margin: 0 auto; }
        
        .page-header { margin-bottom: 30px; border-bottom: 2px solid #e2e8f0; padding-bottom: 15px; display: flex; justify-content: space-between; align-items: center; }
        .page-header h2 { color: #334155; margin: 0; font-size: 24px; }

        .btn-relatorio { background-color: #fff; color: #1e293b; border: 2px solid #cbd5e1; padding: 10px 18px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px; display: flex; align-items: center; gap: 8px; transition: all 0.2s; }
        .btn-relatorio:hover { background-color: #f1f5f9; border-color: #94a3b8; transform: translateY(-2px); }

        /* Dashboard Cards */
        .dashboard { display: flex; gap: 20px; margin-bottom: 30px; }
        .card-dash { flex: 1; padding: 22px; border-radius: 12px; color: white; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .card-receber { background: #10b981; }
        .card-pagar { background: #ef4444; }
        .card-saldo { background: #007bff; }
        .card-dash h3 { margin: 0; font-size: 13px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px; }
        .card-dash h2 { margin: 10px 0 0 0; font-size: 26px; font-weight: bold; }

        /* Painel de Lançamento */
        .card-panel { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); margin-bottom: 30px; border-top: 4px solid #334155; }
        .card-panel h3 { margin-top: 0; margin-bottom: 20px; color: #1e293b; font-size: 18px; }
        form { margin-bottom: 0; display: flex; gap: 12px; flex-wrap: wrap; align-items: flex-end; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group label { font-size: 13px; font-weight: bold; color: #475569; }
        input, select { padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit; font-size: 14px; color: #334155; box-sizing: border-box; }
        input:focus, select:focus { border-color: #007BFF; outline: 3px solid rgba(0, 123, 255, 0.15); }
        button { padding: 11px 24px; background: #334155; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-family: inherit; font-size: 14px; transition: background 0.2s; }
        button:hover { background: #1e293b; }

        /* Listagem / Tabela */
        .table-title { color: #1e293b; font-size: 20px; margin-bottom: 15px; }
        .table-responsive { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #e2e8f0; margin-bottom: 40px; }
        table { border-collapse: collapse; width: 100%; margin: 0; }
        th, td { padding: 14px 20px; text-align: left; font-size: 14px; }
        th { background-color: #f1f5f9; color: #475569; font-weight: bold; border-bottom: 2px solid #e2e8f0; }
        td { border-bottom: 1px solid #f1f5f9; color: #334155; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #f8fafc; }
        
        .btn-baixa { background: #10b981; color: white; padding: 6px 12px; text-decoration: none; border-radius: 6px; font-size: 12px; font-weight: bold; transition: background 0.2s; display: inline-block; }
        .btn-baixa:hover { background: #059669; }
        .btn-excluir { color: #ef4444; text-decoration: none; font-weight: bold; font-size: 14px; margin-left: 10px; }

        /* Container do Gráfico no Fundo da Tela */
        .chart-panel { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border-top: 4px solid #007bff; margin-top: 20px; }
        .chart-panel h3 { margin-top: 0; color: #1e293b; font-size: 18px; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-brand">
            Aexon <span>ERP</span>
        </div>
        <div class="user-info">
            <a href="index.php?rota=dashboard" class="btn-nav-voltar">← Voltar ao Painel</a>
            <span>Olá, <strong><?= $_SESSION['usuario_nome'] ?></strong></span>
            <a href="index.php?rota=sair" class="logout-btn">Sair</a>
        </div>
    </div>

    <div class="container">
        
        <div class="page-header">
            <h2>Módulo Financeiro Empresarial</h2>
            <a href="#relatorio-visual" class="btn-relatorio">📊 Ver Relatório Gráfico</a>
        </div>

        <div class="dashboard">
            <div class="card-dash card-receber">
                <h3>A Receber (Pendente)</h3>
                <h2>R$ <?= number_format($total_receber, 2, ',', '.') ?></h2>
            </div>
            <div class="card-dash card-pagar">
                <h3>A Pagar (Pendente)</h3>
                <h2>R$ <?= number_format($total_pagar, 2, ',', '.') ?></h2>
            </div>
            <div class="card-dash card-saldo" style="background: <?= $saldo_projetado >= 0 ? '#007bff' : '#fd7e14' ?>;">
                <h3>Saldo Projetado</h3>
                <h2>R$ <?= number_format($saldo_projetado, 2, ',', '.') ?></h2>
            </div>
        </div>

        <div class="card-panel">
            <h3>Novo Lançamento Financeiro</h3>
            <form action="index.php?rota=financeiro" method="POST">
                <div class="form-group">
                    <label>Fluxo</label>
                    <select name="tipo" required style="width: 160px;">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Receber">Entrada (Receber)</option>
                        <option value="Pagar">Saída (Pagar)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="descricao" placeholder="Ex: Contrato de Manutenção" required style="width: 220px;">
                </div>

                <div class="form-group">
                    <label>Valor (R$)</label>
                    <input type="number" step="0.01" name="valor" placeholder="0,00" required style="width: 120px;">
                </div>
                
                <div class="form-group">
                    <label>Data Emissão</label>
                    <input type="date" name="data_emissao" required>
                </div>
                
                <div class="form-group">
                    <label>Data Vencimento</label>
                    <input type="date" name="data_vencimento" required>
                </div>
                
                <div class="form-group">
                    <label>Observação</label>
                    <input type="text" name="observacao" placeholder="Detalhes (Opcional)" style="width: 180px;">
                </div>

                <button type="submit">Lançar</button>
            </form>
        </div>

        <h2 class="table-title">Contas e Movimentações</h2>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Emissão</th>
                        <th>Vencimento</th>
                        <th>Descrição</th>
                        <th>Observação</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lancamentos as $lanc): ?>
                    <tr>
                        <td><small><?= date('d/m/Y', strtotime($lanc['data_emissao'])) ?></small></td>
                        <td><strong><?= date('d/m/Y', strtotime($lanc['data_vencimento'])) ?></strong></td>
                        <td><strong><?= $lanc['descricao'] ?></strong></td>
                        <td><small><?= $lanc['observacao'] ?></small></td>
                        <td style="color: <?= $lanc['tipo'] == 'Receber' ? 'green' : 'red' ?>; font-weight: bold;">
                            <?= $lanc['tipo'] ?>
                        </td>
                        <td>R$ <?= number_format($lanc['valor'], 2, ',', '.') ?></td>
                        <td>
                            <?php if($lanc['status'] == 'Pendente'): ?>
                                <span style="color: orange; font-weight: bold;">Pendente</span>
                            <?php else: ?>
                                <span style="color: gray;">
                                    <?= $lanc['status'] ?> em <?= date('d/m', strtotime($lanc['data_pagamento'])) ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($lanc['status'] == 'Pendente'): ?>
                                <a href="index.php?rota=financeiro&acao=baixar&id=<?= $lanc['id'] ?>&tipo=<?= $lanc['tipo'] ?>" class="btn-baixa">Dar Baixa</a>
                            <?php endif; ?>
                            <a href="index.php?rota=financeiro&acao=excluir&id=<?= $lanc['id'] ?>" class="btn-excluir" onclick="return confirm('Excluir este lançamento?');">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="relatorio-visual" class="chart-panel">
            <h3>Demonstrativo Analítico (Projeção de Pendências Atuais)</h3>
            <div style="max-width: 450px; margin: 0 auto;">
                <canvas id="financialDoughnutChart" width="100" height="100"></canvas>
            </div>
        </div>

    </div>

    <script>
        const ctx = document.getElementById('financialDoughnutChart').getContext('2d');
        
        const dynamicChart = new Chart(ctx, {
            type: 'doughnut',
            plugins: [ChartDataLabels], // Ativa o plugin importado lá em cima
            data: {
                labels: ['Total a Receber', 'Total a Pagar'],
                datasets: [{
                    data: [<?= $total_receber ?>, <?= $total_pagar ?>],
                    backgroundColor: ['#10b981', '#ef4444'], // Verde e vermelho Aexon
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 14, weight: 'bold' },
                            padding: 20
                        }
                    },
                    // Configuração dos textos que ficarão por cima do gráfico
                    datalabels: {
                        color: '#ffffff', // Cor da fonte (branca para contrastar)
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        // Essa função formata o número puro para ficar no padrão R$ 1.500,00
                        formatter: function(value, context) {
                            if (value > 0) {
                                return 'R$ ' + value.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                            }
                            return ''; // Esconde o rótulo se o valor for zero
                        }
                    }
                },
                cutout: '60%' // Deixa a parte colorida um pouco mais grossa para caber o texto perfeitamente
            }
        });
    </script>
</body>
</html>