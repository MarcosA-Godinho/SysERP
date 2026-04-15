<?php
// controllers/AuthController.php
require_once 'config/database.php';
require_once 'models/Usuario.php';

class AuthController {
    
    public function telaLogin() {
        require_once 'views/login.php';
    }

    public function logar() {
        $database = new Database();
        $db = $database->getConnection();
        $usuarioModel = new Usuario($db);

        $login_digitado = $_POST['usuario'];
        $senha_digitada = $_POST['senha'];

        // Busca o usuário no banco
        $user_dados = $usuarioModel->buscarPorLogin($login_digitado);

        // password_verify compara a senha digitada com o hash salvo no banco
        if ($user_dados && password_verify($senha_digitada, $user_dados['senha'])) {
            $_SESSION['logado'] = true;
            $_SESSION['usuario_id'] = $user_dados['id'];
            $_SESSION['usuario_nome'] = $user_dados['nome'];
            $_SESSION['usuario_perfil'] = $user_dados['perfil']; // Importante para o Configurador
            
            header("Location: index.php?rota=dashboard");
            exit();
        } else {
            $erro = "Usuário ou senha inválidos!";
            require_once 'views/login.php';
        }
    }

    public function sair() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>