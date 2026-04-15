<?php
// models/Usuario.php

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nome;
    public $login;
    public $senha;
    public $perfil;
    public $ativo;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Função para buscar usuário pelo login para o processo de autenticação
    public function buscarPorLogin($login) {
        $query = "SELECT id, nome, login, senha, perfil, ativo FROM " . $this->table_name . " WHERE login = :login AND ativo = 1 LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listar todos os usuários (para o Módulo Configurador)
    public function lerTodos() {
        $query = "SELECT id, nome, login, perfil, ativo FROM " . $this->table_name . " ORDER BY nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Criar novo usuário com senha protegida
    public function criar() {
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, login=:login, senha=:senha, perfil=:perfil";
        $stmt = $this->conn->prepare($query);

        // Criptografando a senha antes de salvar
        $senha_hash = password_hash($this->senha, PASSWORD_BCRYPT);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":login", $this->login);
        $stmt->bindParam(":senha", $senha_hash);
        $stmt->bindParam(":perfil", $this->perfil);

        return $stmt->execute();
    }

    // Busca um usuário específico pelo ID
    public function lerPorId($id) {
        $query = "SELECT id, nome, login, perfil, ativo FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE (Atualiza os dados do usuário)
    public function atualizar() {
        // Se a senha foi preenchida, atualiza tudo (incluindo a senha com um novo hash)
        if(!empty($this->senha)) {
            $query = "UPDATE " . $this->table_name . " SET nome=:nome, login=:login, senha=:senha, perfil=:perfil, ativo=:ativo WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            
            $senha_hash = password_hash($this->senha, PASSWORD_BCRYPT);
            $stmt->bindParam(":senha", $senha_hash);
        } else {
            // Se a senha veio vazia, atualiza os dados mas MANTÉM a senha antiga intacta
            $query = "UPDATE " . $this->table_name . " SET nome=:nome, login=:login, perfil=:perfil, ativo=:ativo WHERE id=:id";
            $stmt = $this->conn->prepare($query);
        }

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":login", $this->login);
        $stmt->bindParam(":perfil", $this->perfil);
        $stmt->bindParam(":ativo", $this->ativo);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // SOFT DELETE (Apenas muda o status para 0 - Inativo)
    public function inativar($id) {
        $query = "UPDATE " . $this->table_name . " SET ativo = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>