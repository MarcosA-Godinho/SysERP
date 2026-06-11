<?php
// controllers/FuncionarioController.php

require_once 'config/database.php';
require_once 'models/Funcionario.php';

class FuncionarioController {
    private $db;
    private $funcionario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->funcionario = new Funcionario($this->db);
    }

    public function listar() {
        $stmt = $this->funcionario->lerTodos();
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/funcionarios_list.php';
    }

    public function salvar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->funcionario->nome = $_POST['nome'];
            
            // Limpa a máscara do CPF (deixa só números)
            $this->funcionario->cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
            $this->funcionario->cargo = $_POST['cargo'];
            $this->funcionario->salario = $_POST['salario'];

            // O Try...Catch é a melhor prática de UX para lidar com o Banco de Dados
            try {
                if ($this->funcionario->criar()) {
                    header("Location: index.php?rota=rh");
                    exit();
                }
            } catch (PDOException $e) {
                // Código 23000 é o padrão do MySQL para "Violação de Integridade" (Duplicidade)
                if ($e->getCode() == 23000) {
                    echo "<script>
                            alert('ATENÇÃO: O CPF informado já está cadastrado no sistema! Verifique a lista de colaboradores.'); 
                            window.location.href='index.php?rota=rh';
                          </script>";
                    exit();
                } else {
                    echo "Erro crítico no banco de dados: " . $e->getMessage();
                }
            }
        }
    }

    public function editar($id) {
        $func_dados = $this->funcionario->lerPorId($id);
        if($func_dados) {
            require_once 'views/funcionarios_edit.php';
        } else {
            echo "Funcionário não encontrado.";
        }
    }

    public function atualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->funcionario->id = $_POST['id'];
            $this->funcionario->nome = $_POST['nome'];
            $this->funcionario->cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']); 
            $this->funcionario->cargo = $_POST['cargo'];
            $this->funcionario->salario = $_POST['salario'];
            $this->funcionario->ativo = $_POST['ativo']; 

            try {
                if ($this->funcionario->atualizar()) {
                    header("Location: index.php?rota=rh");
                    exit();
                }
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    // window.history.back() devolve o usuário para a tela de edição com os dados que ele já tinha digitado
                    echo "<script>
                            alert('ATENÇÃO: Este CPF já pertence a outro colaborador!'); 
                            window.history.back();
                          </script>";
                    exit();
                } else {
                    echo "Erro crítico no banco de dados: " . $e->getMessage();
                }
            }
        }
    }
}
?>