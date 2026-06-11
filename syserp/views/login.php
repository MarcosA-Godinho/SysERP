<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso - Aexon</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #1e293b; /* Tom azul escuro mais moderno/corporativo */
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-box { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.3); 
            width: 320px; 
            text-align: center; 
        }
        
        /* Estilização do Logo Corporativo (Pure CSS/SVG) */
        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 25px;
        }
        .logo-text {
            font-size: 28px;
            font-weight: bold;
            color: #0f172a;
            letter-spacing: 1px;
            margin-top: 8px;
        }
        .logo-subtitle {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 2px;
        }

        /* Acessibilidade: Labels visíveis e organizadas para UX */
        .input-group {
            text-align: left;
            margin-bottom: 18px;
        }
        .input-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #475569;
            margin-bottom: 6px;
        }
        
        input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #cbd5e1; 
            border-radius: 6px; 
            box-sizing: border-box; 
            font-family: inherit;
            font-size: 14px;
            color: #334155;
            transition: all 0.2s;
        }

        /* ACESSIBILIDADE CRÍTICA: Indicador visual claro de foco para navegação por teclado */
        input:focus {
            border-color: #007BFF;
            outline: 3px solid rgba(0, 123, 255, 0.25);
            background-color: #f8fafc;
        }

        button { 
            width: 100%; 
            padding: 12px; 
            background: #007BFF; 
            color: white; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: bold;
            font-family: inherit;
            transition: background 0.2s, outline 0.2s;
        }
        button:hover { 
            background: #0056b3; 
        }
        button:focus {
            outline: 3px solid rgba(0, 123, 255, 0.4);
        }

        .erro { 
            color: #dc2626; 
            background: #fee2e2;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #fca5a5;
            margin-bottom: 20px; 
            font-size: 14px;
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="login-box">
        
        <div class="logo-container">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M12 2L2 22H7L12 11L17 22H22L12 2Z" fill="#007BFF"/>
                <path d="M12 11L9 17H15L12 11Z" fill="#0056b3"/>
            </svg>
            <div class="logo-text">Aexon</div>
            <div class="logo-subtitle">Sistemas Empresariais</div>
        </div>
        
        <?php if(isset($erro)): ?>
            <p class="erro" role="alert"><?= $erro ?></p>
        <?php endif; ?>

        <form action="index.php?rota=login" method="POST">
            <div class="input-group">
                <label Kakao for="usuario">Usuário ou E-mail</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ex: admin" required autocomplete="username">
            </div>
            
            <div class="input-group">
                <label for="senha">Senha de Acesso</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required autocomplete="current-password">
            </div>
            
            <button type="submit">Entrar no Sistema</button>
        </form>
    </div>
</body>
</html>