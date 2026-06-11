<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurador - Aexon</title>
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

        .navbar-brand { font-size: 24px; font-weight: bold; letter-spacing: 1px; }
        .navbar-brand span { font-size: 12px; color: #94a3b8; font-weight: normal; text-transform: uppercase; letter-spacing: 2px; }
        .user-info { display: flex; align-items: center; gap: 20px; font-size: 14px; }
        .btn-nav-voltar { color: #94a3b8; text-decoration: none; font-weight: bold; transition: color 0.2s; }
        .btn-nav-voltar:hover { color: white; }
        .logout-btn { background: #ef4444; color: white; padding: 8px 16px; text-decoration: none; border-radius: 6px; font-weight: bold; transition: background 0.2s; }
        .logout-btn:hover { background: #dc2626; }

        /* Container Principal */
        .container { padding: 40px; max-width: 1100px; margin: 0 auto; }
        
        .page-header { margin-bottom: 30px; border-bottom: 2px solid #e2e8f0; padding-bottom: 15px; }
        .page-header h2 { color: #334155; margin: 0; font-size: 24px; }

        /* Painel de Cadastro (Com destaque Verde Esmeralda) */
        .card-panel {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            border-top: 4px solid #10b981; 
        }

        .card-panel h3 { margin-top: 0; margin-bottom: 20px; color: #1e293b; font-size: 18px; }

        form { display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group label { font-size: 13px; font-weight: bold; color: #475569; }
        
        input, select {
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-family: inherit;
            font-size: 14px;
            color: #334155;
            box-sizing: border-box;
            transition: all 0.2s;
        }

        input:focus, select:focus { border-color: #10b981; outline: 3px solid rgba(16, 185, 129, 0.15); }

        button {
            padding: 11px 24px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-family: inherit;
            font-size: 14px;
            transition: background 0.2s;
        }
        button:hover { background: #059669; }

        /* Listagem / Tabela */
        .table-title { color: #1e293b; font-size: 20px; margin-bottom: 15px; }
        .table-responsive { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #e2e8f0; }
        table { border-collapse: collapse; width: 100%; margin: 0; }
        th, td { padding: 14px 20px; text-align: left; font-size: 14px; }
        th { background-color: #f1f5f9; color: #475569; font-weight: bold; border-bottom: 2px solid #e2e8f0; }
        td { border-bottom: 1px solid #f1f5f9; color: #334155; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #f8fafc; }

        /* Badges de Permissão Modernos */
        .badge-admin { background: #fef3c7; color: #d97706; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; border: 1px solid #fde68a; }
        .badge-user { background: #e0f2fe; color: #0284c7; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; border: 1px solid #bae6fd; }

        .status-ativo { color: #16a34a; font-weight: bold; }
        .status-inativo { color: #dc2626; font-weight: bold; }

        .btn-edit { color: #007BFF; text-decoration: none; font-weight: bold; margin-right: 15px; }
        .btn-edit:hover { text-decoration: underline; }
        .btn-delete { color: #ef4444; text-decoration: none; font-weight: bold; }
        .btn-delete:hover { text-decoration: underline; }
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
            <h2>Módulo Configurador (Acessos)</h2>
        </div>
        
        <div class="card-panel">
            <h3>Novo Usuário de Sistema</h3>
            <form action="index.php?rota=configurador" method="POST">
                
                <div class="form-group" style="flex: 1;">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" placeholder="Ex: Thais Silva" required style="width: 100%;">
                </div>
                
                <div class="form-group">
                    <label>Login (Acesso)</label>
                    <input type="text" name="login" placeholder="Nome de usuário" required style="width: 180px;">
                </div>
                
                <div class="form-group">
                    <label>Senha Temporária</label>
                    <input type="password" name="senha" placeholder="Senha segura" required style="width: 180px;">
                </div>

                <div class="form-group">
                    <label>Nível de Permissão</label>
                    <select name="perfil" required style="width: 220px;">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="usuario">Padrão (Operacional)</option>
                        <option value="admin">Administrador (Total)</option>
                    </select>
                </div>
                
                <button type="submit">Criar Conta</button>
            </form>
        </div>

        <h2 class="table-title">Contas Registradas</h2>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Perfil</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><strong><?= $user['nome'] ?></strong></td>
                        <td><?= $user['login'] ?></td>
                        <td>
                            <?php if($user['perfil'] === 'admin'): ?>
                                <span class="badge-admin">Administrador</span>
                            <?php else: ?>
                                <span class="badge-user">Usuário Padrão</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($user['ativo'] == 1): ?>
                                <span class="status-ativo">Ativo</span>
                            <?php else: ?>
                                <span class="status-inativo">Bloqueado</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?rota=configurador&acao=editar&id=<?= $user['id'] ?>" class="btn-edit">Editar</a>
                            <a href="index.php?rota=configurador&acao=excluir&id=<?= $user['id'] ?>" onclick="return confirm('Tem certeza que deseja bloquear o acesso de <?= $user['nome'] ?>?');" class="btn-delete">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>