<?php
// models/Funcionario.php

class Funcionario {
    // Variável para guardar a conexão com o banco
    private $conn;
    // Nome da tabela que criamos no MySQL
    private $table_name = "funcionarios";

    // Propriedades do funcionário (idênticas às colunas do banco)
    public $id;
    public $nome;
    public $cpf;
    public $cargo;
    public $salario;
    public $ativo;

    // Construtor: Assim que "chamamos" o Model, entregamos a conexão do banco para ele
    public function __construct($db) {
        $this->conn = $db;
    }

    // --------------------------------------------------------
    // MÉTODOS DO CRUD
    // --------------------------------------------------------

    // 1. READ (Ler todos os funcionários para listar na tela)
    public function lerTodos() {
        // Monta a query SQL
        $query = "SELECT id, nome, cpf, cargo, salario, ativo FROM " . $this->table_name . " ORDER BY data_cadastro DESC";

        // Prepara a query. O prepare() é o que nos protege de SQL Injection!
        $stmt = $this->conn->prepare($query);

        // Executa o comando no banco
        $stmt->execute();

        return $stmt; // Retorna os dados para o Controller usar
    }

    // 2. CREATE (Cadastrar um novo funcionário)
    public function criar() {
        // Monta a query de Inserção. Usamos ':nome', ':cpf' como "âncoras" temporárias
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, cpf=:cpf, cargo=:cargo, salario=:salario";

        $stmt = $this->conn->prepare($query);

        // Limpeza dos dados (segurança extra para evitar códigos maliciosos no HTML)
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->cargo = htmlspecialchars(strip_tags($this->cargo));
        $this->salario = htmlspecialchars(strip_tags($this->salario));

        // Substitui as "âncoras" pelos valores reais (Bind)
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":cargo", $this->cargo);
        $stmt->bindParam(":salario", $this->salario);

        // Executa e verifica se deu certo
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 3. DELETE (Excluir um funcionário)
    public function deletar($id_funcionario) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id_funcionario);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Busca um funcionário específico pelo ID para preencher a tela de edição
    public function lerPorId($id) {
        $query = "SELECT id, nome, cpf, cargo, salario, ativo FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        // Retorna apenas uma linha (um array) com os dados
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE (Atualiza os dados de um funcionário, incluindo o status ativo/inativo)
    public function atualizar() {
        $query = "UPDATE " . $this->table_name . " SET nome=:nome, cpf=:cpf, cargo=:cargo, salario=:salario, ativo=:ativo WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Limpeza dos dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->cargo = htmlspecialchars(strip_tags($this->cargo));
        $this->salario = htmlspecialchars(strip_tags($this->salario));
        $this->ativo = htmlspecialchars(strip_tags($this->ativo));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binds
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":cargo", $this->cargo);
        $stmt->bindParam(":salario", $this->salario);
        $stmt->bindParam(":ativo", $this->ativo);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>