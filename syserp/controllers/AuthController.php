<?php
// controllers/AuthController.php

class AuthController {
    
    // Mostra a tela de login
    public function telaLogin() {
        require_once 'views/login.php';
    }

    // Valida os dados digitados
    public function logar() {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        // Usuário padrão provisório para o protótipo
        if ($usuario === 'admin' && $senha === '1234') {
            // Cria a sessão dizendo que ele está logado
            $_SESSION['logado'] = true;
            $_SESSION['usuario_nome'] = 'Administrador';
            
            // Redireciona para o painel de escolha de módulos
            header("Location: index.php?rota=dashboard");
            exit();
        } else {
            // Se errar, volta para a tela de login com mensagem de erro
            $erro = "Usuário ou senha inválidos!";
            require_once 'views/login.php';
        }
    }

    // Destrói a sessão e volta pro login
    public function sair() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>