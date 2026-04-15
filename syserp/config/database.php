<?php
// config/database.php

class Database {
    // Configurações do banco de dados 
    // Como você está usando o Laragon, o padrão geralmente é root sem senha
    private $host = "localhost";
    private $db_name = "syserp"; // Nome atualizado do banco de dados
    private $username = "root";  // Usuário padrão do MySQL
    private $password = "";      // Senha padrão (deixe vazio se não tiver configurado uma)
    public $conn;

    // Método responsável por gerar e retornar a conexão com o banco
    public function getConnection() {
        $this->conn = null;

        try {
            // Tentativa de criar a conexão usando PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            
            // Define o modo de erro do PDO para lançar exceções. 
            // Isso é ótimo para debugar, pois mostra o erro exato na tela se algo falhar.
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Força a comunicação em UTF-8 para evitar problemas com acentuação (ç, á, ã)
            $this->conn->exec("set names utf8");

            
        } catch(PDOException $exception) {
            // Se o bloco 'try' falhar (ex: senha errada, banco não existe), o 'catch' captura o erro
            echo "Erro de conexão com o banco syserp: " . $exception->getMessage();
        }

        // Retorna a conexão pronta para ser usada pelos nossos Models
        return $this->conn;
    }
}
?>