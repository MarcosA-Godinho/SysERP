<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Configurador - syserp</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-voltar { background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #28a745; color: white; }
        form { margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
        input, select { padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #0056b3; }
        .badge-admin { background: #ffc107; color: #000; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .badge-user { background: #17a2b8; color: #fff; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Módulo Configurador: Gestão de Usuários</h1>
            <a href="index.php?rota=dashboard" class="btn-voltar">Voltar ao Painel</a>
        </div>
        
        <div style="background: #e9ecef; padding: 15px; border-radius: 8px; margin-bottom: 30px;">
            <h3 style="margin-top: 0;">Novo Acesso</h3>
            <form action="index.php?rota=configurador" method="POST">
                <input type="text" name="nome" placeholder="Nome Completo (Ex: Thais)" required style="width: 200px;">
                <input type="text" name="login" placeholder="Nome de Usuário" required>
                <input type="password" name="senha" placeholder="Senha Temporária" required>
                <select name="perfil" required>
                    <option value="" disabled selected>Selecione o Perfil...</option>
                    <option value="usuario">Usuário Padrão (Acesso Operacional)</option>
                    <option value="admin">Administrador (Acesso Total)</option>
                </select>
                <button type="submit">Criar Usuário</button>
            </form>
        </div>

        <h2>Usuários Cadastrados</h2>
        <h2>Usuários Cadastrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Perfil de Acesso</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php foreach($usuarios as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['nome'] ?></td>
                <td><strong><?= $user['login'] ?></strong></td>
                <td>
                    <?php if($user['perfil'] === 'admin'): ?>
                        <span class="badge-admin">Administrador</span>
                    <?php else: ?>
                        <span class="badge-user">Usuário Padrão</span>
                    <?php endif; ?>
                </td>
                <td style="color: <?= $user['ativo'] == 1 ? 'green' : 'red' ?>; font-weight: bold;">
                    <?= $user['ativo'] == 1 ? 'Ativo' : 'Bloqueado' ?>
                </td>
                <td>
                    <a href="index.php?rota=configurador&acao=editar&id=<?= $user['id'] ?>" style="color: #007BFF; text-decoration: none; font-weight: bold; margin-right: 10px;">Editar</a>
                    <a href="index.php?rota=configurador&acao=excluir&id=<?= $user['id'] ?>" onclick="return confirm('Tem certeza que deseja bloquear o acesso de <?= $user['nome'] ?>?');" style="color: red; text-decoration: none; font-weight: bold;">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>