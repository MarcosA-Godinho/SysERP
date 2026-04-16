<?php
// controllers/FinanceiroController.php

require_once 'config/database.php';
require_once 'models/Lancamento.php';

class FinanceiroController {
    private $db;
    private $lancamentoModel;

    public function __construct() {
        // Verifica se a pessoa está logada
        if (!isset($_SESSION['logado'])) {
            header("Location: index.php?rota=login");
            exit();
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->lancamentoModel = new Lancamento($this->db);
    }

    // Lista os lançamentos e calcula os totais
    public function listar() {
        $lancamentos = $this->lancamentoModel->lerTodos();
        
        // Variáveis para o nosso Painel de Resumo (Dashboard)
        $total_receber = 0;
        $total_pagar = 0;
        
        foreach($lancamentos as $lanc) {
            // Só somamos o que ainda está Pendente
            if ($lanc['status'] == 'Pendente') {
                if ($lanc['tipo'] == 'Receber') {
                    $total_receber += $lanc['valor'];
                } else {
                    $total_pagar += $lanc['valor'];
                }
            }
        }
        $saldo_projetado = $total_receber - $total_pagar;

        // Carrega a tela passando os lançamentos e os totais
        require_once 'views/financeiro_list.php';
    }

    // Salva um novo lançamento
    public function salvar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->lancamentoModel->descricao = $_POST['descricao'];
            $this->lancamentoModel->observacao = $_POST['observacao'];
            $this->lancamentoModel->valor = $_POST['valor'];
            $this->lancamentoModel->data_vencimento = $_POST['data_vencimento'];
            $this->lancamentoModel->tipo = $_POST['tipo'];
            $this->lancamentoModel->status = 'Pendente'; // Entra sempre como pendente

            if ($this->lancamentoModel->criar()) {
                header("Location: index.php?rota=financeiro");
                exit();
            } else {
                echo "Erro ao cadastrar lançamento.";
            }
        }
    }

    // Função rápida para dar baixa (Mudar para Pago/Recebido)
    public function baixar($id, $tipo) {
        $novo_status = ($tipo == 'Receber') ? 'Recebido' : 'Pago';
        $data_hoje = date('Y-m-d'); // Pega a data atual do servidor
        
        if ($this->lancamentoModel->alterarStatus($id, $novo_status, $data_hoje)) {
            header("Location: index.php?rota=financeiro");
            exit();
        } else {
            echo "Erro ao dar baixa no lançamento.";
        }
    }
    
    // Exclui um lançamento que foi feito errado
    public function excluir($id) {
        if ($this->lancamentoModel->excluir($id)) {
            header("Location: index.php?rota=financeiro");
            exit();
        } else {
            echo "Erro ao excluir lançamento.";
        }
    }
}
?>