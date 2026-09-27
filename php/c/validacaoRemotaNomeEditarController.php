<?php
session_start();
require_once '../conexao.php';
require_once '../m/validacaoRemotaNomeEditarModel.php';

try {
$nome = $_GET['nome'] ?? '';
$id = (int)($_GET['id'] ?? 0);

echo nomeRepeteEdicao($conexao, $nome, $id) ? "false" : "true";
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}


exit;
?>