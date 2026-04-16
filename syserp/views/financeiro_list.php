<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Módulo Financeiro - syserp</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-voltar { background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        
        /* Dashboard Cards */
        .dashboard { display: flex; gap: 20px; margin-bottom: 30px; }
        .card-dash { flex: 1; padding: 20px; border-radius: 8px; color: white; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-receber { background: #28a745; }
        .card-pagar { background: #dc3545; }
        .card-saldo { background: #007bff; }
        .card-dash h3 { margin: 0; font-size: 16px; opacity: 0.9; }
        .card-dash h2 { margin: 10px 0 0 0; font-size: 28px; }

        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #343a40; color: white; }
        
        form { margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; }
        input, select { padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background: #343a40; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        
        .btn-baixa { background: #28a745; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .btn-excluir { color: red; text-decoration: none; font-weight: bold; font-size: 14px; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">Módulo Financeiro</h1>
            <a href="index.php?rota=dashboard" class="btn-voltar">Voltar ao Painel</a>
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

        <div style="background: #e9ecef; padding: 15px; border-radius: 8px; margin-bottom: 30px;">
            <h3 style="margin-top: 0;">Novo Lançamento</h3>
            <form action="index.php?rota=financeiro" method="POST">
                <select name="tipo" required>
                    <option value="" disabled selected>Tipo de Movimentação...</option>
                    <option value="Receber">Entrada (A Receber)</option>
                    <option value="Pagar">Saída (A Pagar)</option>
                </select>
                <input type="text" name="descricao" placeholder="Descrição (Ex: Conta de Luz)" required>
                <input type="number" step="0.01" name="valor" placeholder="Valor (R$)" required>
                <input type="date" name="data_vencimento" required title="Data de Vencimento">
                <input type="text" name="observacao" placeholder="Observação (Opcional)">
                <button type="submit">Lançar</button>
            </form>
        </div>

        <h2>Contas e Movimentações</h2>
        <table>
            <tr>
                <th>Vencimento</th>
                <th>Descrição</th>
                <th>Observação</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php foreach($lancamentos as $lanc): ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($lanc['data_vencimento'])) ?></td>
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
        </table>
    </div>
</body>
</html>