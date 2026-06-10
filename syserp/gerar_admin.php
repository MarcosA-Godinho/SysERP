<?php
// gerar_admin.php

require_once 'config/database.php';
require_once 'models/Usuario.php';

// Conecta no banco
$database = new Database();
$db = $database->getConnection();

// Limpa qualquer 'admin' que já exista para não dar erro de duplicidade
$db->exec("DELETE FROM usuarios WHERE login = 'admin'");

// Prepara o Model
$usuario = new Usuario($db);
$usuario->nome = "Administrador Master";
$usuario->login = "admin";
$usuario->senha = "1234"; // Nossa função criar() vai transformar isso em um hash real!
$usuario->perfil = "admin";

// Tenta criar no banco
if ($usuario->criar()) {
    echo "<h1>Administrador criado com sucesso!</h1>";
    echo "<p>O PHP gerou o hash correto para a senha '1234'.</p>";
    echo "<a href='index.php'>Clique aqui para ir para a tela de Login</a>";
} else {
    echo "<h1>Erro ao criar administrador.</h1>";
}
?>