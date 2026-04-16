<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Módulo RH - syserp</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        
        /* Estilos do cabeçalho e botão voltar */
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-voltar { background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn-voltar:hover { background: #5a6268; }

        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007BFF; color: white; }
        form { margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; }
        input { padding: 10px; width: 200px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header">
            <h1 style="margin: 0;">Módulo RH / DP</h1>
            <a href="index.php?rota=dashboard" class="btn-voltar">Voltar ao Painel</a>
        </div>
        
        <div style="background: #e9ecef; padding: 15px; border-radius: 8px; margin-bottom: 30px;">
            <h3 style="margin-top: 0;">Novo Funcionário</h3>
            <form action="index.php?rota=rh" method="POST">
                <input type="text" name="nome" placeholder="Nome Completo" required>
                <input type="text" name="cpf" placeholder="CPF (000.000.000-00)" maxlength="14" required>
                <input type="text" name="cargo" placeholder="Cargo" required>
                <input type="number" step="0.01" name="salario" placeholder="Salário (Ex: 2500.00)" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>

        <h2>Funcionários Cadastrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Cargo</th>
                <th>Salário (R$)</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
            <?php foreach($funcionarios as $func): ?>
            <tr>
                <td><?= $func['id'] ?></td>
                <td><?= $func['nome'] ?></td>
                
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
                <td><?= number_format($func['salario'], 2, ',', '.') ?></td>
                
                <td style="font-weight: bold; color: <?= $func['ativo'] == 1 ? 'green' : 'red' ?>;">
                    <?= $func['ativo'] == 1 ? 'Sim' : 'Não' ?>
                </td>
                
                <td>
                    <a href="index.php?rota=rh&acao=editar&id=<?= $func['id'] ?>" style="color: #007BFF; text-decoration: none; font-weight: bold;">Editar / Opções</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
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