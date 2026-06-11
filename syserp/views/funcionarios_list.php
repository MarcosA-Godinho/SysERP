<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos Humanos - Aexon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        /* Navbar Corporativa Aexon */
        .navbar {
            background-color: #1e293b;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .navbar-brand span {
            font-size: 12px;
            color: #94a3b8;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 14px;
        }

        .btn-nav-voltar {
            color: #94a3b8;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s;
        }

        .btn-nav-voltar:hover {
            color: white;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* Container Principal */
        .container {
            padding: 40px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 30px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
        }

        .page-header h2 {
            color: #334155;
            margin: 0;
            font-size: 24px;
        }

        /* Painel de Cadastro */
        .card-panel {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            border-top: 4px solid #007BFF;
        }

        .card-panel h3 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #1e293b;
            font-size: 18px;
        }

        form {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: bold;
            color: #475569;
        }

        input {
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-family: inherit;
            font-size: 14px;
            color: #334155;
            width: 200px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #007BFF;
            outline: 3px solid rgba(0, 123, 255, 0.15);
        }

        button {
            padding: 11px 24px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-family: inherit;
            font-size: 14px;
            transition: background 0.2s;
        }

        button:hover {
            background: #218838;
        }

        /* Listagem / Tabela */
        .table-title {
            color: #1e293b;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .table-responsive {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 0;
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: bold;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        .status-ativo {
            color: #16a34a;
            font-weight: bold;
        }

        .status-inativo {
            color: #dc2626;
            font-weight: bold;
        }

        .btn-edit {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-edit:hover {
            text-decoration: underline;
        }
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
            <h2>Recursos Humanos / Departamento Pessoal</h2>
        </div>
        
        <div class="card-panel">
            <h3>Novo Colaborador</h3>
            <form action="index.php?rota=rh" method="POST">
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" placeholder="Nome do funcionário" required style="width: 240px;">
                </div>
                
                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" name="cpf" placeholder="000.000.000-00" maxlength="14" required>
                </div>
                
                <div class="form-group">
                    <label>Cargo</label>
                    <input type="text" name="cargo" placeholder="Função desempenhada" required>
                </div>
                
                <div class="form-group">
                    <label>Salário Base (R$)</label>
                    <input type="number" step="0.01" name="salario" placeholder="Valor mensal" required>
                </div>
                
                <button type="submit">Cadastrar</button>
            </form>
        </div>

        <h2 class="table-title">Colaboradores Registrados</h2>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Salário</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($funcionarios as $func): ?>
                    <tr>
                        <td><?= $func['id'] ?></td>
                        <td><strong><?= $func['nome'] ?></strong></td>
                        <td>
                            <?php 
                                $cpf = $func['cpf'];
                                if(strlen($cpf) == 11) {
                                    echo preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
                                } else {
                                    echo $cpf; 
                                }
                            ?>
                        </td>
                        <td><?= $func['cargo'] ?></td>
                        <td>R$ <?= number_format($func['salario'], 2, ',', '.') ?></td>
                        <td>
                            <?php if($func['ativo'] == 1): ?>
                                <span class="status-ativo">Sim</span>
                            <?php else: ?>
                                <span class="status-inativo">Não</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?rota=rh&acao=editar&id=<?= $func['id'] ?>" class="btn-edit">Editar / Opções</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const inputCpf = document.querySelector('input[name="cpf"]');
        inputCpf.addEventListener('input', function (e) {
            let value = e.target.value;
            value = value.replace(/\D/g, "");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            e.target.value = value;
        });
    </script>
</body>
</html>