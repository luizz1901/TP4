<?php
require_once '../requireDuplo.php';
require_once '../m/tabelaUsuariosModel.php';

try {
    $pesquisa = $_GET['pesquisa'] ?? '';
    $limite = (int) ($_GET['limite'] ?? 10);
    $totalRegistros = contarTotalUsuarios($conexao, $pesquisa);
    require_once '../paginas.php';
    $usuarios = listarUsuarios($conexao, $pesquisa, $limite, $offset);
    $conexao = null;
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
require '../v/tabelaUsuariosView.php';
?>