<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Painel - syserp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 40px;
            text-align: center;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: #c82333;
        }

        .modulos-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        /* Estilos dos Cards */
        .card {
            background: white;
            padding: 40px 20px;
            width: 250px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            text-decoration: none;
            color: #333;
            display: block;
            border-top: 5px solid #007BFF;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            color: #007BFF;
            margin-top: 0;
        }

        /* Card Desativado */
        .disabled {
            background: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
            border-top: 5px solid #6c757d;
        }

        .disabled h3 {
            color: #6c757d;
        }

        /* Card Configurador (Especial para Admin) */
        .card-admin {
            border-top: 5px solid #28a745;
        }

        .card-admin h3 {
            color: #28a745;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Bem-vindo, <?= $_SESSION['usuario_nome'] ?>!</h1>
        <a href="index.php?rota=sair" class="logout-btn">Sair do Sistema</a>
    </div>

    <h2>Selecione o módulo desejado:</h2>

    <div class="modulos-container">
        <a href="index.php?rota=rh" class="card">
            <h3>Módulo RH / DP</h3>
            <p>Gestão de Funcionários, Cadastros e Opções</p>
        </a>

        <a href="index.php?rota=financeiro" class="card">
            <h3>Módulo Financeiro</h3>
            <p>Gestão de Contas a Pagar e Receber</p>
        </a>

        <<?php if ($_SESSION['usuario_perfil'] === 'admin'): ?>
            <a href="index.php?rota=configurador" class="card card-admin">
            <h3>Módulo Configurador</h3>
            <p>Gestão de Usuários e Permissões</p>
            </a>
        <?php endif; ?>
    </div>
</body>

</html>