<?php
session_start();
require_once '../conexao.php';
require_once '../m/validacaoRemotaNomeArtBandaModel.php';

try {
    $nome = $_GET['nome'] ?? '';
    echo artistaExiste($conexao, $nome) ? "false" : "true";
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
exit;

?>