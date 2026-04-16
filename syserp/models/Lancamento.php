<?php
// models/Lancamento.php

class Lancamento {
    private $conn;
    private $table_name = "lancamentos";

    public $id;
    public $descricao;
    public $observacao; // Nosso novo campo!
    public $valor;
    public $data_vencimento;
    public $data_pagamento;
    public $tipo;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // LER TODOS: Traz as contas ordenadas pelas que vencem primeiro
    public function lerTodos() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY data_vencimento ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // LER POR ID: Para preencher a tela de edição
    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CRIAR: Grava um novo lançamento no banco
    public function criar() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET descricao=:descricao, observacao=:observacao, valor=:valor, 
                      data_vencimento=:data_vencimento, tipo=:tipo, status=:status";
        
        $stmt = $this->conn->prepare($query);

        // Limpeza dos dados
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->observacao = htmlspecialchars(strip_tags($this->observacao));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Binds
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":observacao", $this->observacao);
        $stmt->bindParam(":valor", $this->valor);
        $stmt->bindParam(":data_vencimento", $this->data_vencimento);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":status", $this->status);

        return $stmt->execute();
    }

    // ATUALIZAR: Salva edições completas
    public function atualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET descricao=:descricao, observacao=:observacao, valor=:valor, 
                      data_vencimento=:data_vencimento, tipo=:tipo, status=:status 
                  WHERE id=:id";
                  
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":observacao", $this->observacao);
        $stmt->bindParam(":valor", $this->valor);
        $stmt->bindParam(":data_vencimento", $this->data_vencimento);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // DAR BAIXA: Função rápida para mudar o status para Pago/Recebido e salvar a data de hoje
    public function alterarStatus($id, $novo_status, $data_pagamento) {
        $query = "UPDATE " . $this->table_name . " SET status = :status, data_pagamento = :data_pagamento WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":status", $novo_status);
        $stmt->bindParam(":data_pagamento", $data_pagamento);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    // EXCLUIR: Apaga o lançamento
    public function excluir($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>