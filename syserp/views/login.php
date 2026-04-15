<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - syserp</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #2c3e50; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); width: 300px; text-align: center; }
        .login-box h2 { margin-bottom: 20px; color: #333; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background: #0056b3; }
        .erro { color: red; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Acesso syserp</h2>
        
        <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>

        <form action="index.php?rota=login" method="POST">
            <input type="text" name="usuario" placeholder="Usuário (admin)" required>
            <input type="password" name="senha" placeholder="Senha (1234)" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>