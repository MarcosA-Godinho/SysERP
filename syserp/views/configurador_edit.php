<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário - syserp</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); max-width: 500px; margin: auto; }
        form { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; }
        input, select { padding: 10px; border: 1px solid #ccc; border-radius: 4px; width: 100%; box-sizing: border-box; }
        .buttons { display: flex; gap: 10px; margin-top: 10px; }
        button { padding: 10px 20px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; flex: 1; font-weight: bold; }
        button:hover { background: #0056b3; }
        .btn-cancel { background: #6c757d; text-align: center; text-decoration: none; display: inline-block; flex: 1; line-height: 20px; color: white; padding: 10px 20px; border-radius: 4px; font-weight: bold; }
        .btn-cancel:hover { background: #5a6268; }
        .aviso-senha { font-size: 12px; color: #666; margin-top: -10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Usuário</h2>
        
        <form action="index.php?rota=configurador" method="POST">
            <input type="hidden" name="id" value="<?= $user_dados['id'] ?>">
            
            <div>
                <label>Nome Completo</label>
                <input type="text" name="nome" value="<?= $user_dados['nome'] ?>" required>
            </div>

            <div>
                <label>Login de Acesso</label>
                <input type="text" name="login" value="<?= $user_dados['login'] ?>" required>
            </div>

            <div>
                <label>Nova Senha</label>
                <input type="password" name="senha" placeholder="Digite apenas para alterar a senha">
                <p class="aviso-senha">* Deixe em branco para manter a senha atual.</p>
            </div>

            <div>
                <label>Perfil de Acesso</label>
                <select name="perfil">
                    <option value="usuario" <?= $user_dados['perfil'] == 'usuario' ? 'selected' : '' ?>>Usuário Padrão</option>
                    <option value="admin" <?= $user_dados['perfil'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>

            <div>
                <label>Status</label>
                <select name="ativo">
                    <option value="1" <?= $user_dados['ativo'] == 1 ? 'selected' : '' ?>>Ativo (Acesso Liberado)</option>
                    <option value="0" <?= $user_dados['ativo'] == 0 ? 'selected' : '' ?>>Inativo (Acesso Bloqueado)</option>
                </select>
            </div>

            <div class="buttons">
                <button type="submit">Salvar Alterações</button>
                <a href="index.php?rota=configurador" class="btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>