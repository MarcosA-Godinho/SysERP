<?php
// index.php
session_start();

// Pega a rota da URL. Se não tiver nenhuma, o padrão é ir pro dashboard
$rota = isset($_GET['rota']) ? $_GET['rota'] : 'dashboard';

// SEGURANÇA: Se não estiver logado E não estiver na tela de login, joga pro login
if (!isset($_SESSION['logado']) && $rota != 'login') {
    header("Location: index.php?rota=login");
    exit();
}

// O Guarda de Trânsito: Decide qual Controller chamar baseado na rota
switch ($rota) {
    case 'login':
        require_once 'controllers/AuthController.php';
        $auth = new AuthController();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $auth->logar();
        } else {
            $auth->telaLogin();
        }
        break;

    case 'sair':
        require_once 'controllers/AuthController.php';
        $auth = new AuthController();
        $auth->sair();
        break;

    case 'dashboard':
        require_once 'views/dashboard.php';
        break;

    case 'rh':
        // Toda a lógica antiga do RH veio para cá!
        require_once 'controllers/FuncionarioController.php';
        $controller = new FuncionarioController();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['id']) && !empty($_POST['id'])) {
                $controller->atualizar();
            } else {
                $controller->salvar();
            }
        } 
        else if (isset($_GET['acao']) && $_GET['acao'] == 'editar' && isset($_GET['id'])) {
            $controller->editar($_GET['id']);
        } 
        else {
            $controller->listar();
        }
        break;
}
?>