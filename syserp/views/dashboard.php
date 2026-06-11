<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Aexon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc; /* Um cinza muito suave, moderno */
            margin: 0;
            padding: 0;
        }

        /* Navbar Corporativa Aexon */
        .navbar {
            background-color: #1e293b; /* Azul corporativo escuro */
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
            display: flex;
            align-items: center;
            gap: 10px;
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

        .logout-btn {
            background: #ef4444; /* Vermelho moderno */
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

        /* Container Principal */
        .container {
            padding: 50px 40px;
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .page-header {
            margin-bottom: 50px;
        }

        .page-header h2 {
            color: #334155;
            margin: 0 0 10px 0;
            font-size: 28px;
        }

        .page-header p {
            color: #64748b;
            margin: 0;
            font-size: 16px;
        }

        .modulos-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        /* Estilos dos Cards Premium */
        .card {
            background: white;
            padding: 40px 30px;
            width: 240px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 10px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-top: 6px solid #007BFF;
            position: relative;
            overflow: hidden;
        }

        /* Efeito de fundo sutil no topo do card */
        .card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(180deg, rgba(0,123,255,0.03) 0%, rgba(255,255,255,0) 100%);
            z-index: 0;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 45px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .card h3 {
            color: #0f172a;
            margin: 0 0 12px 0;
            font-size: 20px;
            position: relative;
            z-index: 1;
        }

        .card p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.5;
            position: relative;
            z-index: 1;
        }

        /* Card Configurador (Especial para Admin) */
        .card-admin {
            border-top-color: #10b981; /* Verde esmeralda */
        }
        .card-admin::before {
            background: linear-gradient(180deg, rgba(16,185,129,0.03) 0%, rgba(255,255,255,0) 100%);
        }

        .footer {
            margin-top: 60px;
            color: #94a3b8;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="navbar-brand">
            Aexon <span>ERP</span>
        </div>
        <div class="user-info">
            <span>Olá, <strong><?= $_SESSION['usuario_nome'] ?></strong></span>
            <a href="index.php?rota=sair" class="logout-btn">Sair do Sistema</a>
        </div>
    </div>

    <div class="container">
        
        <div class="page-header">
            <h2>Área de Trabalho</h2>
            <p>Selecione o módulo que deseja gerir</p>
        </div>

        <div class="modulos-container">
            
            <a href="index.php?rota=rh" class="card">
                <div class="card-icon">👥</div>
                <h3>Recursos Humanos</h3>
                <p>Gestão de equipa, folha de pagamento e estruturação de cargos.</p>
            </a>

            <a href="index.php?rota=financeiro" class="card">
                <div class="card-icon">📊</div>
                <h3>Financeiro</h3>
                <p>Monitorização de fluxo de caixa, contas a pagar e receitas.</p>
            </a>

            <?php if ($_SESSION['usuario_perfil'] === 'admin'): ?>
                <a href="index.php?rota=configurador" class="card card-admin">
                    <div class="card-icon">⚙️</div>
                    <h3>Configurador</h3>
                    <p>Controle de permissões e gestão de utilizadores da plataforma.</p>
                </a>
            <?php endif; ?>

        </div>

        <div class="footer">
            &copy; <?= date('Y') ?> Aexon Sistemas Empresariais.
        </div>
    </div>

</body>

</html>