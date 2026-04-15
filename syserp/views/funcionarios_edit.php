<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Funcionário - syserp</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); max-width: 500px; margin: auto; }
        form { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; }
        input, select { padding: 10px; border: 1px solid #ccc; border-radius: 4px; width: 100%; box-sizing: border-box; }
        .buttons { display: flex; gap: 10px; margin-top: 10px; }
        button { padding: 10px 20px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; flex: 1; }
        button:hover { background: #0056b3; }
        .btn-cancel { background: #6c757d; text-align: center; text-decoration: none; display: inline-block; flex: 1; line-height: 20px; }
        .btn-cancel:hover { background: #5a6268; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Funcionário / Opções</h2>
        
        <?php 
            // Formata o CPF para exibição na tela de edição
            $cpf_formatado = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $func_dados['cpf']);
        ?>

        <form action="index.php?rota=rh" method="POST">
            <input type="hidden" name="id" value="<?= $func_dados['id'] ?>">
            
            <div>
                <label>Nome Completo</label>
                <input type="text" name="nome" value="<?= $func_dados['nome'] ?>" required>
            </div>

            <div>
                <label>CPF</label>
                <input type="text" name="cpf" value="<?= $cpf_formatado ?>" maxlength="14" required>
            </div>

            <div>
                <label>Cargo</label>
                <input type="text" name="cargo" value="<?= $func_dados['cargo'] ?>" required>
            </div>

            <div>
                <label>Salário (R$)</label>
                <input type="number" step="0.01" name="salario" value="<?= $func_dados['salario'] ?>" required>
            </div>

            <div>
                <label>Status do Funcionário (Soft Delete)</label>
                <select name="ativo">
                    <option value="1" <?= $func_dados['ativo'] == 1 ? 'selected' : '' ?>>Ativo (Trabalhando)</option>
                    <option value="0" <?= $func_dados['ativo'] == 0 ? 'selected' : '' ?>>Inativo (Bloqueado/Demitido)</option>
                </select>
            </div>

            <div class="buttons">
                <button type="submit">Salvar Alterações</button>
                <a href="index.php?rota=rh" class="btn-cancel button" style="color: white; padding: 10px 20px; border-radius: 4px;">Cancelar</a>
            </div>
        </form>
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