<?php
session_start();
require_once '../conexao.php';
require_once '../m/validacaoRemotaNomeUsuarioModel.php';

try {
    $nome = $_POST['nome'] ?? '';
    $id = $_POST['id'] ?? '';

    echo usuarioExiste($conexao, $nome, $id) ? "false" : "true";
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
?>