<?php
require_once '../requireDuplo.php';
require_once '../m/excluirArtBandaModel.php';

try {
    $idForm = (int) ($_GET['id'] ?? 0);

    if ($idForm > 0) {
        exclusao($conexao, $idForm);
        echo "Sucesso!";
        header("Location: ../c/tabelaArtBandaController.php");
    }

    $conexao = null;
    exit;
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
?>