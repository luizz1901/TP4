<?php
require_once '../requireDuplo.php';
require_once '../m/tabelaMusicasModel.php';

try {
    $pesquisa = $_GET['pesquisa'] ?? '';
    $limite = (int) ($_GET['limite'] ?? 10);

    $totalRegistros = contarTotalMusicas($conexao, $pesquisa);

    require_once '../paginas.php';

    $musicas = listarMusicas($conexao, $pesquisa, $limite, $offset);

    $conexao = null;
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}


require '../v/tabelaMusicasView.php';
?>