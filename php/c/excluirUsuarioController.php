<?php
require_once '../requireDuplo.php';
require_once '../m/excluirUsuarioModel.php';

try {
    $idUsuarioLogado = (int) $_SESSION['id'];

    if ($idUsuarioLogado > 0) {

        exclusao($conexao, $idUsuarioLogado);
        session_destroy();

        header("Location: ../c/loginUsuarioController.php");
        exit;
    }

    $conexao = null;
    exit;
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
?>