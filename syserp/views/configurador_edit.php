<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - Aexon</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f8fafc; 
            margin: 0; 
            padding: 0; 
        }
        
        /* Navbar Corporativa Unificada */
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

        /* Ficha de Edição Centralizada */
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
            border-top: 4px solid #10b981; /* Verde administrativo */
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
            border-color: #10b981; 
            outline: 3px solid rgba(16, 185, 129, 0.15); 
            background-color: #f8fafc; 
        }

        .aviso-senha { 
            font-size: 12px; 
            color: #64748b; 
            margin: 2px 0 0 0; 
        }

        /* Botões Operacionais */
        .buttons-group { 
            display: flex; 
            gap: 12px; 
            margin-top: 10px; 
        }
        
        button {
            flex: 1; 
            padding: 12px 20px; 
            background: #10b981; 
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
            background: #059669; 
        }
        
        .btn-cancel {
            flex: 1; 
            padding: 12px 20px; 
            background: #64748b; 
            color: white; 
            text-align: center; 
            text-decoration: none;
            border-radius: 6px; 
            font-weight: bold; 
            font-family: inherit; 
            font-size: 15px; 
            line-height: 20px; 
            box-sizing: border-box; 
            transition: background 0.2s;
        }
        
        .btn-cancel:hover { 
            background: #475569; 
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-brand">
            Aexon <span>ERP</span>
        </div>
        <div class="user-info">
            <a href="index.php?rota=configurador" class="btn-nav-voltar">← Voltar ao Configurador</a>
            <span>Olá, <strong><?= $_SESSION['usuario_nome'] ?></strong></span>
            <a href="index.php?rota=sair" class="logout-btn">Sair</a>
        </div>
    </div>

    <div class="container">
        <div class="card-panel">
            <h2>Alterar Conta de Sistema</h2>
            
            <form action="index.php?rota=configurador" method="POST">
                <input type="hidden" name="id" value="<?= $user_dados['id'] ?>">
                
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" value="<?= $user_dados['nome'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Login de Acesso</label>
                    <input type="text" name="login" value="<?= $user_dados['login'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Redefinir Senha</label>
                    <input type="password" name="senha" placeholder="Digite apenas se quiser alterar">
                    <p class="aviso-senha">* Deixe o campo vazio para manter a senha atual estável.</p>
                </div>

                <div class="form-group">
                    <label>Perfil de Acesso</label>
                    <select name="perfil">
                        <option value="usuario" <?= $user_dados['perfil'] == 'usuario' ? 'selected' : '' ?>>Usuário Padrão (Operacional)</option>
                        <option value="admin" <?= $user_dados['perfil'] == 'admin' ? 'selected' : '' ?>>Administrador (Total)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status da Conta</label>
                    <select name="ativo">
                        <option value="1" <?= $user_dados['ativo'] == 1 ? 'selected' : '' ?>>Ativa (Acesso Liberado)</option>
                        <option value="0" <?= $user_dados['ativo'] == 0 ? 'selected' : '' ?>>Inativa (Acesso Bloqueado)</option>
                    </select>
                </div>

                <div class="buttons-group">
                    <button type="submit">Salvar Permissões</button>
                    <a href="index.php?rota=configurador" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>