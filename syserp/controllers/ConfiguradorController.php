<?php
// controllers/ConfiguradorController.php

require_once 'config/database.php';
require_once 'models/Usuario.php';

class ConfiguradorController {
    private $db;
    private $usuarioModel;

    public function __construct() {
        // SEGURANÇA MÁXIMA: Se não for admin, chuta de volta pro dashboard
        if (!isset($_SESSION['usuario_perfil']) || $_SESSION['usuario_perfil'] !== 'admin') {
            header("Location: index.php?rota=dashboard");
            exit();
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuarioModel = new Usuario($this->db);
    }

    // Lista os usuários na tela
    public function listar() {
        $usuarios = $this->usuarioModel->lerTodos();
        require_once 'views/configurador.php';
    }

    // Salva um novo usuário
    public function salvar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->usuarioModel->nome = $_POST['nome'];
            $this->usuarioModel->login = $_POST['login'];
            $this->usuarioModel->senha = $_POST['senha'];
            $this->usuarioModel->perfil = $_POST['perfil'];

            if ($this->usuarioModel->criar()) {
                header("Location: index.php?rota=configurador");
                exit();
            } else {
                echo "Erro ao cadastrar usuário.";
            }
        }
    }

    // Carrega a tela de edição
    public function editar($id) {
        $user_dados = $this->usuarioModel->lerPorId($id);
        if($user_dados) {
            require_once 'views/configurador_edit.php';
        } else {
            echo "Usuário não encontrado.";
        }
    }

    // Salva as alterações
    public function atualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->usuarioModel->id = $_POST['id'];
            $this->usuarioModel->nome = $_POST['nome'];
            $this->usuarioModel->login = $_POST['login'];
            $this->usuarioModel->senha = $_POST['senha']; // Pode vir vazia
            $this->usuarioModel->perfil = $_POST['perfil'];
            $this->usuarioModel->ativo = $_POST['ativo'];

            if ($this->usuarioModel->atualizar()) {
                header("Location: index.php?rota=configurador");
                exit();
            } else {
                echo "Erro ao atualizar usuário.";
            }
        }
    }

    // Excluir (Inativar rapidamente pela tabela)
    public function excluir($id) {
        // Prevenção extra: Não deixa o Admin Master inativar a si mesmo por acidente
        if ($id == $_SESSION['usuario_id']) {
            echo "<script>alert('Você não pode excluir seu próprio usuário atual!'); window.location.href='index.php?rota=configurador';</script>";
            exit();
        }

        if ($this->usuarioModel->inativar($id)) {
            header("Location: index.php?rota=configurador");
            exit();
        } else {
            echo "Erro ao excluir usuário.";
        }
    }
    
}
?>