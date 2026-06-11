<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Colaborador - Aexon</title>
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

        /* Container Centralizado para a Ficha de Edição */
        .container {
            padding: 40px;
            max-width: 550px;
            margin: 40px auto;
        }

        .card-panel {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-top: 4px solid #007BFF;
        }

        .card-panel h2 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #1e293b;
            font-size: 22px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: bold;
            color: #475569;
        }

        input, select {
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-family: inherit;
            font-size: 14px;
            color: #334155;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.2s;
        }

        input:focus, select:focus {
            border-color: #007BFF;
            outline: 3px solid rgba(0, 123, 255, 0.15);
            background-color: #f8fafc;
        }

        /* Alinhamento dos Botões Operacionais */
        .buttons-group {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        button {
            flex: 1;
            padding: 12px 20px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-family: inherit;
            font-size: 15px;
            transition: background 0.2s;
        }

        button:hover {
            background: #0056b3;
        }

        .btn-cancel {
            flex: 1;
            padding: 12px 20px;
            background: #6c757d;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-family: inherit;
            font-size: 15px;
            line-height: 20px; /* Garante alinhamento vertical exato com o botão */
            box-sizing: border-box;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-brand">
            Aexon <span>ERP</span>
        </div>
        <div class="user-info">
            <a href="index.php?rota=rh" class="btn-nav-voltar">← Voltar para o RH</a>
            <span>Olá, <strong><?= $_SESSION['usuario_nome'] ?></strong></span>
            <a href="index.php?rota=sair" class="logout-btn">Sair</a>
        </div>
    </div>

    <div class="container">
        <div class="card-panel">
            <h2>Alterar Cadastro de Colaborador</h2>
            
            <?php 
                // Mantém a formatação limpa do CPF para a visualização do usuário
                $cpf_formatado = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $func_dados['cpf']);
            ?>

            <form action="index.php?rota=rh" method="POST">
                <input type="hidden" name="id" value="<?= $func_dados['id'] ?>">
                
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" value="<?= $func_dados['nome'] ?>" required>
                </div>

                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" name="cpf" value="<?= $cpf_formatado ?>" maxlength="14" required>
                </div>

                <div class="form-group">
                    <label>Cargo / Função</label>
                    <input type="text" name="cargo" value="<?= $func_dados['cargo'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Salário Base (R$)</label>
                    <input type="number" step="0.01" name="salario" value="<?= $func_dados['salario'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Status do Funcionário (Soft Delete)</label>
                    <select name="ativo">
                        <option value="1" <?= $func_dados['ativo'] == 1 ? 'selected' : '' ?>>Ativo (Trabalhando)</option>
                        <option value="0" <?= $func_dados['ativo'] == 0 ? 'selected' : '' ?>>Inativo (Acesso Bloqueado/Demitido)</option>
                    </select>
                </div>

                <div class="buttons-group">
                    <button type="submit">Salvar Alterações</button>
                    <a href="index.php?rota=rh" class="btn-cancel">Cancelar</a>
                </div>
            </form>
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