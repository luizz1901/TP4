<?php
require_once '../requireDuplo.php';
require_once '../m/excluirMusicaModel.php';

try {
    $idForm = (int) ($_GET['id'] ?? 0);
    if (exclusao($conexao, $idForm)) {
        http_response_code(200);
        echo "Sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao excluir no Model.";
    }
    $conexao = null;
    exit;
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}

?>