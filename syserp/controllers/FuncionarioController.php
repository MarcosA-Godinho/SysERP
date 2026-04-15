<?php
// controllers/FuncionarioController.php

// Puxamos os arquivos de configuração e o Model que criamos
require_once 'config/database.php';
require_once 'models/Funcionario.php';

class FuncionarioController {
    private $db;
    private $funcionario;

    public function __construct() {
        // Toda vez que o Controller for chamado, ele já abre a conexão com o banco
        $database = new Database();
        $this->db = $database->getConnection();
        // E já prepara o Model do Funcionario
        $this->funcionario = new Funcionario($this->db);
    }

    // Método que busca os dados no banco e chama a tela do usuário (View)
    public function listar() {
        $stmt = $this->funcionario->lerTodos();
        // Transforma o resultado do banco em um array (lista) do PHP
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Carrega a tela HTML passando a variável $funcionarios para ela
        require_once 'views/funcionarios_list.php';
    }

    // Método ativado quando o usuário clica em "Cadastrar" no formulário
    public function salvar() {
        // Verifica se os dados vieram via método POST (envio de formulário)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Pega os dados digitados na tela e joga para o Model
            $this->funcionario->nome = $_POST['nome'];
            
            // --- INÍCIO DA ALTERAÇÃO DO CPF ---
            // Pega o CPF que veio da tela (com pontos e traço)
            $cpf_digitado = $_POST['cpf'];
            // O preg_replace procura tudo que NÃO for número (0-9) e substitui por vazio ('')
            $this->funcionario->cpf = preg_replace('/[^0-9]/', '', $cpf_digitado);
            // --- FIM DA ALTERAÇÃO DO CPF ---

            $this->funcionario->cargo = $_POST['cargo'];
            $this->funcionario->salario = $_POST['salario'];

            // Tenta criar no banco
            if ($this->funcionario->criar()) {
                // Se der certo, redireciona de volta para a tela inicial (limpando o formulário)
                header("Location: index.php?rota=rh");
                exit(); // É uma boa prática colocar um exit() após um redirecionamento de header
            } else {
                echo "Erro ao cadastrar funcionário.";
            }
        }
    }
    // Carrega a tela de edição com os dados do funcionário
    public function editar($id) {
        // Busca os dados no banco usando o Model
        $func_dados = $this->funcionario->lerPorId($id);
        
        if($func_dados) {
            // Se encontrou, carrega a tela passando os dados
            require_once 'views/funcionarios_edit.php';
        } else {
            echo "Funcionário não encontrado.";
        }
    }

    // Método ativado quando o usuário clica em "Salvar Alterações"
    public function atualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->funcionario->id = $_POST['id'];
            $this->funcionario->nome = $_POST['nome'];
            $this->funcionario->cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']); // Limpa o CPF
            $this->funcionario->cargo = $_POST['cargo'];
            $this->funcionario->salario = $_POST['salario'];
            $this->funcionario->ativo = $_POST['ativo']; // Recebe o status ativo/inativo

            if ($this->funcionario->atualizar()) {
                header("Location: index.php?rota=rh");
                exit();
            } else {
                echo "Erro ao atualizar funcionário.";
            }
        }
    }
}
?>